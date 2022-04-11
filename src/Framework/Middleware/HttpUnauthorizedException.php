<?php

namespace Framework\Middleware;

class HttpUnauthorizedException extends \Exception
{
    protected $code = 401;
    protected $message = "Unauthorized";

}