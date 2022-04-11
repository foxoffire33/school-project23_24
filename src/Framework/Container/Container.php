<?php

namespace Framework\Container;

use Framework\Cache\MemCacheService;
use Framework\Container\Interfaces\ContainerInterface;
use Framework\Core\Application;
use Framework\core\Attribute;
use Framework\core\Config;
use Framework\core\Singleton;
use Framework\database\MysqlConnection;
use Framework\Router\Attributes\HttpGet;
use http\Exception;
use MongoDB\BSON\Type;

class Container implements ContainerInterface
{
    const MEMCACHE_KEY = 'container_cache';
    private static array $entries = [];

    private MemCacheService $memCacheService;

    public function __construct()
    {
        $this->memCacheService = MemCacheService::getInstance();
        $this->memCacheService->FlushAll();
        $cache = $this->memCacheService->getByKey(self::MEMCACHE_KEY);
        if($cache)
            self::$entries = $cache;
    }

    /**
     * Deze functie wordt een gebroepen om een classes de resolven met alle depenencies injected
     * @param string $id
     * @return mixed|object|void|null
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = self::$entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset(self::$entries[$id]);
    }

    public function set(string $id, callable $concrete): void
    {
        self::$entries[$id] = $concrete;
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

        $this->memcache->setKey(self::MEMCACHE_KEY, self::$entries);
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
        $counter = -1;
        return array_map(
            function (\ReflectionParameter $parameter) use ($id, $counter, $constructor) {
                $name = $parameter->getName();


                $type = $parameter->getType();
                $counter += 1;
                if (!$type)
                    //   throw new \Exception('Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint');

                    if ($type instanceof \ReflectionUnionType)
                        throw new \Exception('Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"');


                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin())
                    return $this->get($type->getName());

//                if ($type instanceof \ReflectionNamedType && $type->isBuiltin())
//                    return func_get_arg($parameter->getPosition());

                throw new \Exception('Failed to resolve class "' . $id . '" because invalid param "' . $name . '"');
            },
            $parameters
        );
    }

//
//
//    private function trySingleton(string $id)
//    {
//        $reflectionClass = new \ReflectionClass($id);
//        $method = $reflectionClass->getMethod('getInstance');
//        if ($method->isStatic() && empty($reflectionClass->getProperties()))
//            return static($reflectionClass->getName())::getInstance();
//    }
//
//    private function tryDefaultClass(string $id)
//    {
//        $reflectionClass = new \ReflectionClass($id);
//        $constructor = $reflectionClass->getConstructor();
//        $parameters = array_merge($constructor?->getParameters() ?? [], $reflectionClass->getAttributes());
//
//        if (!$constructor || !$parameters)
//            return new $id;
//    }
}