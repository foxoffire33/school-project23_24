<?php

namespace Framework\Router;

use App\Http\Controller\AuthenticateController;
use App\Http\Controller\CoinController;
use App\Http\Controller\RegisterController;
use App\Http\Controller\SiteController;
use App\Http\Controller\TransactionController;
use App\Http\Controller\UsersController;
use App\Http\Controller\WalledController;
use App\Models\Transaction;
use Framework\Container\Container;
use Framework\Core\Application;
use Framework\database\MysqlConnection;
use Framework\Middleware\AbstractHandler;
use Framework\Middleware\Interfaces\Handler;
use Framework\Router\enums\HttpMethods;
use Framework\router\exceptions\RouterActionDuplicatedException;
use Framework\Router\exceptions\RouterActionNotFound;
use Framework\Router\exceptions\UnsupportedRequestMethod;
use Framework\Router\interfaces\RouterInterface;

class Router implements RouterInterface
{

    private readonly HttpMethods $supportedRequestMethods;

    private AbstractHandler $middleware;

    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => []
    ];

    private array $routerControllers = [
        SiteController::class,
        UsersController::class,
        RegisterController::class,
        CoinController::class,
        TransactionController::class,
        AuthenticateController::class,
        WalledController::class
    ];

    public function __construct(private Container $container)
    {
        $this->register($this->routerControllers);
    }


    /**
     * @param string $requestUrl
     * support callback function and class::method functions
     * @return void
     * @throws UnsupportedRequestMethod
     */
    public function resolve(HttpRequest $request): ?string
    {

        $path = explode('?', $_SERVER['REQUEST_URI']);
        $attribute = $this->routes[$request->method->value][$path[0]] ?? null;

        if ($attribute !== null) {
            if (class_exists($attribute['action']?->class) && method_exists($attribute['action']?->class, $attribute['action']?->name)) {
                if(isset($attribute['middleware'])){//handel loop all middelware
                    $middelware = $attribute['middleware'];
                    //$middelware = $this->container->get($middelware);
                    do {
                        $middelware = $middelware->handle();
                    }while(!is_null($middelware) && $middelware->hasNext());
                }
                //Use DI Container to resolve the class
                $class = $this->container->get($attribute['action']?->class);
                return call_user_func_array([$class, $attribute['action']?->name], [$request]);
            }
        } else {
            throw new RouterActionNotFound();
        }
        return '';
    }

    public function register(array $controllers)
    {
        foreach ($controllers as $controller) {
            $reflection = new \ReflectionClass($controller);
           $this->addAttributes($reflection->getAttributes());
            foreach ($reflection->getMethods() as $method) {
                $this->addAttributes($method->getAttributes(),$method);
            }
        }
    }

    private function addAttributes($attributes, $method = null){

        foreach ($attributes as $attribute) {
           // $route = $this->container->get($attribute->getName());
         //  // var_dump($route);exit;
            $route = $attribute->newInstance();
            if ($route instanceof HttpRoute) {
                $lastRoute = $route;
                if (!array_key_exists($lastRoute->method->value, $this->routes[$lastRoute->method->value])) {
                    $this->routes[$lastRoute->method->value][$lastRoute->path]['action'] = $method;
                } else {
                    throw new RouterActionDuplicatedException();
                }
            } else if ($route instanceof Handler && !is_null($lastRoute)) {
                if (!isset($this->routes[$lastRoute->method->value][$lastRoute->path]['middleware'])){
                    $this->routes[$lastRoute->method->value][$lastRoute->path]['middleware'] = $route;
                }else {
                    $this->routes[$lastRoute->method->value][$lastRoute->path]['middleware'] = $this->routes[$lastRoute->method->value][$lastRoute->path]['middleware']?->setNext($route);
                }
            }
        }
    }
}