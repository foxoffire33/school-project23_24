<?php

namespace Framework\Router\interfaces;

use Framework\router\HttpRequest;

interface RouterInterface
{
    public function register(array $controllers);
    public function resolve(HttpRequest $request): ?string;
}