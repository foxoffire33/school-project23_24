<?php

namespace Framework\Container;

use Framework\CacheHandler\MemCacheService;
use Framework\Container\Interfaces\ContainerInterface;
use Framework\Core\Application;
use Framework\core\Attribute;
use Framework\core\Config;
use Framework\core\Factories\SingletonFactory;
use Framework\core\Singleton;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Router\Attributes\HttpGet;
use http\Exception;
use MongoDB\BSON\Type;

class Container extends SingletonFactory implements ContainerInterface
{
    const MEMCACHE_KEY = 'container';
    private static array $entries = [];

    private MemCacheService $memCacheService;

    public function __construct()
    {
        $this->memCacheService = MemCacheService::getInstance();
    }

    /**
     * Deze functie wordt een gebroepen om een classes de resolven met alle depenencies injected
     * @param string $id
     * @return mixed|object|void|null
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $cache = $this->memCacheService->setKey(self::MEMCACHE_KEY, self::$entries);
            if ($cache[$id])
                self::$entries[$id] = $cache[$id];

            $entry = self::$entries[$id];

            if (is_callable($entry))
                return $entry($this);

            if (is_object($entry))
                return $entry;

            $id = $entry;
        }

        $resolve = $this->resolve($id);
        $this->set($id, $resolve);

        return self::$entries[$id];
    }

    public function has(string $id): bool
    {
        $cache = $this->memCacheService->setKey(self::MEMCACHE_KEY, self::$entries);
        return isset(self::$entries[$id]) || isset($cache[$id]);
    }

    public function set(string $id, callable|object $concrete): void
    {
        self::$entries[$id] = $concrete;
        $this->memCacheService->setKey(self::MEMCACHE_KEY, self::$entries);
    }

    /**
     * Hier wordt de claas op gehaald en gekenen welke dependencies de claas heeft
     * @param string $id
     * @return mixed|object|void|null
     * @throws \ReflectionException
     */
    public function resolve(string $id)
    {

        $reflectionClass = new \ReflectionClass($id);
        $constructor = $reflectionClass->getConstructor();
        $parameters = array_merge($constructor?->getParameters() ?? []);

        //Controleer of het een defualt class is
        if ($reflectionClass->isInstantiable()) {
            if (!$constructor || !$parameters)
                return new $id;

            $dependencies = $this->loadDependencies($parameters, $id, $constructor);
            return $reflectionClass->newInstanceArgs($dependencies);
        }

        //Conteroleer of is heet Singleton is
        if (!$reflectionClass->isInstantiable() && $reflectionClass->hasMethod('getInstance')) {
            return $this->loadFactory($reflectionClass, $id);
        }
    }

    private function loadFactory(\ReflectionClass $reflectionClass, string $id)
    {
        $constructor = $reflectionClass->getConstructor();
        $parameters = $constructor?->getParameters() ?? [];

        if (empty($parameters))
            return $id::getInstance();

        $dependencies = $this->loadDependencies($parameters, $id, $constructor);
        return $id::getInstance($dependencies);
    }

    private function loadDependencies(array $parameters, string $id, $constructor)
    {
        return array_map(
            function (\ReflectionParameter $parameter) use ($id, $constructor) {
                $name = $parameter->getName();


                $type = $parameter->getType();
                if (!$type)
                    throw new \Exception('Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint');

                if ($type instanceof \ReflectionUnionType)
                    throw new \Exception('Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"');


                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin())
                    return $this->get($type->getName());

//                if ($type instanceof \ReflectionNamedType && $type->isBuiltin()){
//
//                }


                throw new \Exception('Failed to resolve class "' . $id . '" because invalid param "' . $name . '"');
            },
            $parameters
        );
    }

}