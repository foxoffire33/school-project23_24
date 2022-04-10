<?php

namespace Framework\Router\Attributes;

use Framework\Router\HttpRoute;
use Framework\router\interfaces\RouterAttributeInterface;

#[\Attribute]
class HttpPut extends HttpRoute implements RouterAttributeInterface
{
    public function __construct(public string $path = '')
    {

        parent::__construct($this->path);
    }
}