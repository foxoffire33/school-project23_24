<?php

namespace Framework\core\Factories;

class AttributeFactory
{
    public static function getInstance(?array $args = null)
    {
        $class = get_called_class();

        $reflectionClass = new \ReflectionClass($class);
        $instance = $reflectionClass->newInstance();
        return $instance;
    }
}