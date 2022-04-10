<?php

namespace Framework\core;

class AttributeFactory
{
    public static function getInstance(?array $args = null)
    {
        $class = get_called_class();
        $numberOfArgs = func_num_args();

        $reflectionClass = new \ReflectionClass($class);
        $instance = $reflectionClass->newInstance();

//        var_dump($instance);exit;

        return $instance;
    }
}