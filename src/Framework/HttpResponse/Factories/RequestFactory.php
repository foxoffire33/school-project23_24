<?php

namespace Framework\HttpResponse\Factories;

use Framework\HttpResponse\HttpRequest;
use Framework\HttpResponse\HttpResponse;
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