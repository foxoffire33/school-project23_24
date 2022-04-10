<?php

namespace Framework\Router\Attributes;

use Framework\core\AttributeFactory;
use Framework\database\MysqlConnection;
use Framework\router\enums\HttpMethods;
use Framework\Router\HttpRoute;
use Framework\router\interfaces\RouterAttributeInterface;

#[\Attribute]
class HttpGet extends HttpRoute
{

    public HttpMethods $method;

    public function __construct(public string $path)
    {
        parent::__construct($this->path);
    }
}