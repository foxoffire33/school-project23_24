<?php

namespace Framework\HttpResponse\Factories;

use Framework\HttpResponse\HttpResponse;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return new HttpResponse($code,getallheaders(),$reasonPhrase);
    }
}