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
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\router\HttpRequest;
use Framework\router\Route;
use Framework\router\Router;

class Application
{
    private array $middleware = [];

    private Router $router;


    public function __construct(public Container $container)
    {
      //  set_exception_handler("\Framework\core\ExceptionHandler::handler");

        if (!isset($_SESSION))
            session_start();

        $this->router = $this->container->get(Router::class);


    }

    public function repsonse(): ?string
    {
        return $this->router->resolve(new HttpRequest());
    }

    public static function getContainer(){
        return new Container();
    }
}