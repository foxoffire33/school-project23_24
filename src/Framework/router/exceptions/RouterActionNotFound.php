<?php

namespace Framework\router\exceptions;

class RouterActionNotFound extends \Exception
{
    protected $code = 404;
    protected $message = "Route not found";
}