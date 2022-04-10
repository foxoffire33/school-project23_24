<?php

namespace Framework\AccessControl\Attributes;

#[\Attribute]
class CanAttribute
{

    public function __construct(public string $controller, public string $action)
    {

    }

}