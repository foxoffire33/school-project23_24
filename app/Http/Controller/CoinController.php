<?php

namespace App\Http\Controller;

use Framework\AccessControl\AccessControl;
use Framework\Core\Application;
use Framework\DatabaseHandler\MysqlConnection;
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
    #[ThrottleMiddleware(120, 60)]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class, 'index')]
    public function index(): ?string
    {
        return $this->view->resolve('Coin/Index', ['models' => Coin::findAll()]);
    }

    #[HttpGet('/coins/show')]
    #[ThrottleMiddleware(120, 60)]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class, 'show')]
    public function show(HttpRequest $httpRequest): ?string
    {
        $entity = Coin::findById($httpRequest->attributes->id);
        return $this->view->resolve('Coin/Show', ['model' => $entity]);
    }
}