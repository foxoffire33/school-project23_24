<?php

namespace Framework\HttpResponse\Factories;

use Framework\HttpResponse\Uri;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

class UriFactory implements UriFactoryInterface
{

    public function createUri(string $uri = ''): UriInterface
    {
        return new Uri($uri);
    }
}