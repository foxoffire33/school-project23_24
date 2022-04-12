<?php

namespace Framework\Router;

use Framework\core\Factories\AttributeFactory;
use Framework\router\enums\HttpMethods;

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


        // TODO: Implement resolve() method.
    }
}