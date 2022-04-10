<?php

namespace Framework\Container\Exceptions;

use Framework\Container\Interfaces\NotFoundExceptionInterface;

class ContainerNotFoundException extends \Exception implements NotFoundExceptionInterface
{

}