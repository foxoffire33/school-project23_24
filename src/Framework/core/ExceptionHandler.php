<?php

namespace Framework\core;

use Framework\view\View;

class ExceptionHandler
{
    public static function handler($exception)
    {
        $view = Application::getContainer()->get(View::class);
        header("HTTP/1.1 {$exception->getCode()} {$exception->getMessage()}");
        $view->resolve('Layouts/HttpException', ['exception' => $exception]);
    }
}