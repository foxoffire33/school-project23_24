<?php

namespace App\Http\Controller;

use App\Models\Users;
use Framework\AccessControl\AccessControl;
use Framework\Core\Application;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Middleware\Attributes\ThrottleMiddleware;
use Framework\Router\Attributes\HttpDelete;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPatch;
use Framework\Router\Attributes\HttpPost;
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
        return $this->view->resolve('Coin/Admin', ['entities' => Coin::findAll()]);
    }

    #[HttpGet('/coins/:id')]
    #[ThrottleMiddleware(120, 60)]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class, 'show')]
    public function show(int $id): ?string
    {
        $entity = Coin::findById($id);
        return $this->view->resolve('Coin/Show', ['model' => $entity]);
    }

    #[HttpDelete('/coins/:id')]
    #[RoleBasedAccessMiddleware(self::class,'delete')]
    public function delete(int $id){
        $entity = Coin::findById($id);
        if($entity->delete())
            header('location: /coins');
    }

    #[HttpGet('/coins/admin')]
    #[RoleBasedAccessMiddleware(self::class,'admin')]
    public function admin(){
        return $this->view->resolve('Coin/Admin',['entities' => Coin::findAll()]);
    }

    #[HttpGet('/coins/:id/edit')]
    #[RoleBasedAccessMiddleware(self::class,'edit')]
    public function edit(int $id){
        return $this->view->resolve('Coin/Edit', ['entity' => Coin::findByIdOrFail($id)]);
    }

    #[HttpGet('/coins/create')]
    #[RoleBasedAccessMiddleware(self::class,'create')]
    public function create(){
        return $this->view->resolve('Coin/Edit');
    }

    #[HttpPost('/coins')]
    #[RoleBasedAccessMiddleware(self::class,'create')]
    public function save(){
        $entity = Coin::create($_POST);
        if($entity->save())
            header("Location: /coins");
    }

    #[HttpPatch('/coins/:id')]
    #[RoleBasedAccessMiddleware(self::class,'update')]
    public function update(int $id){
        $entity = Coin::findByIdOrFail($id);
        $entity->update($_POST);
        if($entity->save())
            header("Location: /coins");
    }
}