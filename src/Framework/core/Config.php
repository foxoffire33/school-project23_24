<?php

namespace Framework\core;

use Framework\core\Factories\SingletonFactory;

class Config extends SingletonFactory
{
    private ?array $config = null;

    private function __construct()
    {

        if (is_null($this->config)) {
            $this->config = include $_SERVER['DOCUMENT_ROOT'] . '/../app/Config/app.php';
        }
    }

    public function __get(string $name)
    {
        return $this->config[$name];
    }
}