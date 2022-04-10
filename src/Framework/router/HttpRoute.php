<?php

namespace Framework\Router;

use Framework\core\Attribute;
use Framework\core\AttributeFactory;
use Framework\router\enums\HttpMethods;
use Framework\router\interfaces\RouteInterface;

class HttpRoute extends AttributeFactory
{
    public function __construct(
        public string $path,
        public HttpMethods $method = HttpMethods::GET
    )
    {
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.

        return true;
    }

    public function resolve(): void
    {
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $action = $this->routes[$_SERVER['REQUEST_METHOD']][$path] ?? null;

        // TODO: Implement resolve() method.
    }
}