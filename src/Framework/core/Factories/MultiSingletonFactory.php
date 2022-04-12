<?php

namespace Framework\core\Factories;

abstract class MultiSingletonFactory extends SingletonFactory {

    public static function singletonHash( $class, $args ) {
        return md5( $class . '_' . serialize( $args ) );
    }
}