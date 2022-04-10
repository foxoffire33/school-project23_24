<?php

namespace Framework\Middleware;
use Framework\Middleware\Interfaces\Handler;
use Framework\Router\HttpRoute;

abstract class AbstractHandler implements Handler
{
    /**
     * @var Handler
     */
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle();
        }

        return null;
    }

    public function hasNext(): bool {
        return isset($this->nextHandler);
    }
}