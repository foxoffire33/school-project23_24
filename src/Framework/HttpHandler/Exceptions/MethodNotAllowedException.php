<?php

namespace Framework\HttpHandler\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class MethodNotAllowedException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, $previous = null)
    {
        $message = $_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed';
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        parent::__construct($message, 405, $previous);
    }
}