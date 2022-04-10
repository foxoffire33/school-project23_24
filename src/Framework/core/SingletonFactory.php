<?php

namespace Framework\core;

use ReflectionClass;

class SingletonFactory
{
    protected static $instances = [];

    public static function getInstance(array $args = [])
    {
        $class = get_called_class();

        $hash = $class::singletonHash($class, $args);


        if (!array_key_exists($hash, self::$instances)) {
            $reflectionClass = new ReflectionClass($class);
            $instance = $reflectionClass->newInstanceWithoutConstructor();

                $constructor = $reflectionClass->getConstructor();
                if (is_null($constructor))
                    $instance = $reflectionClass->newInstanceArgs($args);


                $constructor = $reflectionClass->getConstructor();
                $constructor->setAccessible(true);
                $constructor->invokeArgs($instance, $args);
                $constructor->setAccessible(false);

            self::$instances[$hash] = $instance;

        }
        return self::$instances[$hash];
    }

    private static function singletonHash($class, $args)
    {
        return $class;
    }
}