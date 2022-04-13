<?php

namespace Framework\core;

use Framework\Container\Container;
use Framework\HttpHandler\HttpRequest;
use Framework\HttpHandler\HttpResponse;
use Framework\router\Router;

class Application
{
    private array $middleware = [];

    private Router $router;


    public function __construct(public Container $container)
    {
        set_exception_handler("\Framework\core\ExceptionHandler::handler");

        if (!isset($_SESSION))
            session_start();

        $this->router = $this->container->get(Router::class);
    }

    public function repsonse(): ?string
    {
        $httpRequest = new HttpRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        $applicationResponse = $this->router->resolve($httpRequest);
        $response = new HttpResponse(200, [], $applicationResponse);
        return $response->getBody();
    }

    public static function getContainer()
    {
        return new Container();
    }
}