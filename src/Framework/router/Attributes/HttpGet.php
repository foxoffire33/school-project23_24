<?php

namespace Framework\Router\Attributes;

use Framework\router\enums\HttpMethods;
use Framework\Router\HttpRoute;

#[\Attribute]
class HttpGet extends HttpRoute
{

    public HttpMethods $method;

    public function __construct(public string $path)
    {
        parent::__construct($this->path);
    }
}