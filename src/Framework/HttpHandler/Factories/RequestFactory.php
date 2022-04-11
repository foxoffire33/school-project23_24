<?php

namespace Framework\HttpHandler\Factories;

use Framework\HttpHandler\HttpRequest;
use Framework\HttpHandler\HttpResponse;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestFactory implements RequestFactoryInterface
{

    public function createRequest(string $method, $uri): RequestInterface
    {
        return new HttpRequest($method, $uri);
    }
}