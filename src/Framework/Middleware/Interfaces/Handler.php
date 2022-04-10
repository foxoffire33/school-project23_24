<?php

namespace Framework\Middleware\Interfaces;

use Framework\Router\HttpRoute;

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function hasNext(): bool;

    public function handle(): ?string;

}
