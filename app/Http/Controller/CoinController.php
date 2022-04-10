<?php

namespace App\Http\Controller;

use Framework\AccessControl\AccessControl;
use Framework\Core\Application;
use Framework\database\MysqlConnection;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Middleware\Attributes\ThrottleMiddleware;
use Framework\Router\Attributes\HttpGet;
use Framework\router\HttpRequest;
use Framework\Validator\Validator;
use Framework\view\View;
use App\Models\Coin;

class CoinController extends Controller
{

    #[HttpGet('/coins')]
    #[ThrottleMiddleware(120,60)]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'index')]
    public function index(): void
    {
        $this->view->resolve('Coin/Index',['models' =>  Coin::findAll()]);
    }

    #[HttpGet('/coins/show')]
    #[ThrottleMiddleware(120,60)]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'show')]
    public function show(HttpRequest $httpRequest): void
    {
        $this->view->resolve('Coin/Show',['model' =>  Coin::findById($httpRequest->attributes->id)]);
    }
}