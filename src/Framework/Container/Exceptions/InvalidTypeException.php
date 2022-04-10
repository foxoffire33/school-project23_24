<?php

namespace Framework\Container\Exceptions;

use Framework\Container\Interfaces\NotFoundExceptionInterface;

class InvalidTypeException extends \Exception implements NotFoundExceptionInterface
{

}