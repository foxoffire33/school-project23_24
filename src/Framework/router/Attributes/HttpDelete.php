<?php

namespace Framework\Router\Attributes;

use Framework\router\enums\HttpMethods;
use Framework\Router\HttpRoute;
use Framework\router\interfaces\RouterAttributeInterface;

#[\Attribute]
class HttpDelete extends HttpRoute implements RouterAttributeInterface
{
    public function __construct(public string $path = '')
    {
        parent::__construct($this->path);
        $this->method = HttpMethods::DELETE;
    }
}