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
use Framework\Cache\MemCache;
use Framework\Cache\MemCacheService;
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

    const CACHED_ROUTE_KEY = 'router_routes';
    private static array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => []
    ];

    private static array $routesMiddleWare = [
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

    /**
     * Er wordt gebruikt gemaakt van cache alle routes staan in de cache, als ze dat niet staat worden ze resolved
     * @param Container $container
     * @param MemCacheService $memCache
     */
    public function __construct(private Container $container, private MemCacheService $memCache)
    {
        //is de cache leeg resolve dan alle routes en zet deze in de cache
        if (empty($this->memCache->getByKey(self::CACHED_ROUTE_KEY))) {
            $this->register($this->routerControllers);
         //   $this->memCache->setKey(self::CACHED_ROUTE_KEY, self::$routes);
        }

        //Haal alle routes op uit de cache
      //  self::$routes = $this->memCache->getByKey(self::CACHED_ROUTE_KEY);
    }


    public function resolve(\Framework\HttpResponse\HttpRequest|HttpRequest $request): ?string
    {

        $httpMethod = $request->getMethod();
        $httpUrl = $request->getUri();

        $path = explode('?', $httpUrl);
        $route = self::$routes[$httpMethod][$path[0]] ?? null;
        $routeMiddleware = self::$routesMiddleWare[$httpMethod][$path[0]] ?? null;

        if ($route !== null) {
            if (class_exists($route['class']) && method_exists($route['class'], $route['action'])) {
                if (isset($routeMiddleware)) {//handel loop all middelware
                    $middelware = $routeMiddleware;
                    //$middelware = $this->container->get($middelware);
                    do {
                        $middelware = $middelware->handle();
                    } while (!is_null($middelware) && $middelware->hasNext());
                }
                //Use DI Container to resolve the class
                $class = $this->container->get($route['class']);
                return call_user_func_array([$class, $route['action']], []);
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
            //  $this->addAttributes($reflection->getAttributes());
            foreach ($reflection->getMethods() as $method) {
                $this->addAttributes($method->getAttributes(), $method);
            }
        }
    }

    private function addAttributes($attributes, $method = null)
    {

        foreach ($attributes as $attribute) {
            $route = $attribute->newInstance();
            if ($route instanceof HttpRoute) {
                $lastRoute = $route;
                if (!array_key_exists($lastRoute->method->value, self::$routes[$lastRoute->method->value])) {
                    self::$routes[$lastRoute->method->value][$lastRoute->path] = ['class' => $method->class, 'action' => $method->name];
                } else {
                    throw new RouterActionDuplicatedException();
                }
            } else if ($route instanceof Handler && !is_null($lastRoute)) {
                if (!isset(self::$routesMiddleWare[$lastRoute->method->value][$lastRoute->path])) {
                    self::$routesMiddleWare[$lastRoute->method->value][$lastRoute->path] = $route;
                } else {
                    self::$routesMiddleWare[$lastRoute->method->value][$lastRoute->path] = self::$routesMiddleWare[$lastRoute->method->value][$lastRoute->path]?->setNext($route);
                }
            }
        }
    }
}