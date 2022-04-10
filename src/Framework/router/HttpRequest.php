<?php

namespace Framework\router;

use Framework\router\enums\HttpMethods;

class HttpRequest
{
    public readonly HttpMethods $method;
    public readonly object $attributes;
    public readonly  string $path;

    public function __construct()
    {
        $this->path = explode('?', $_SERVER['REQUEST_URI'])[0] ?? null;
        $this->method = $this->getMethod();
        $this->attributes = $this->resolveRequest();
    }

    private function getMethod(): HttpMethods
    {
        return match ($_SERVER['REQUEST_METHOD']) {
            'GET' => HttpMethods::GET,
            'POST' => HttpMethods::POST,
        };
    }

    private function resolveRequest(): object
    {
        return match ($this->method) {
            HttpMethods::GET => (object)$_GET,
            HttpMethods::POST => (object)$_POST,
            default => throw new \Exception('Unexpected match value'),
        };
    }
}