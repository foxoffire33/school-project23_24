<?php

namespace Framework\Core;

use App\Http\Controller\AuthenticateController;
use App\Http\Controller\CoinController;
use App\Http\Controller\RegisterController;
use App\Http\Controller\SiteController;
use App\Http\Controller\TransactionController;
use App\Http\Controller\UsersController;
use App\Http\Controller\WalledController;
use Framework\Cache\MemCacheService;
use Framework\Container\Container;
use Framework\database\MysqlConnection;
use Framework\HttpResponse\HttpRequest;
use Framework\HttpResponse\HttpResponse;
use Framework\HttpResponse\Response;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\router\Route;
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