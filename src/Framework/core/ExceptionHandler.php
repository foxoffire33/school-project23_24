<?php

namespace Framework\core;

use Framework\view\View;

class ExceptionHandler
{
    public static function handler($exception): void
    {
        $view = Application::getContainer()->get(View::class);
        if($exception->getCode() > 0)
            header("HTTP/1.1 {$exception->getCode()} {$exception->getMessage()}");
        echo $view->resolve('Layouts/HttpException', ['exception' => $exception]);
    }
}