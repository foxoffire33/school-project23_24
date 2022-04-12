<?php

namespace App\Http\Controller;

use App\Models\Users;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpDelete;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPatch;
use Framework\Router\Attributes\HttpPost;

class UsersController extends Controller
{


    #[HttpGet('/users')]
    #[RoleBasedAccessMiddleware(self::class,'index')]
    public function index(){
        return $this->view->resolve('User/Index',['entities' => Users::findAll()]);
    }

    #[HttpGet('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'show')]
    public function show(){
        return "Home";
    }

    #[HttpGet('/users/:id/edit')]
    #[RoleBasedAccessMiddleware(self::class,'edit')]
    public function edit(int $id){
        return $this->view->resolve('User/Edit', ['entity' => Users::findById($id)]);
    }

    #[HttpGet('/users/create')]
    #[RoleBasedAccessMiddleware(self::class,'create')]
    public function create(){
        return $this->view->resolve('User/Edit');
    }

    #[HttpPost('/users')]
    #[RoleBasedAccessMiddleware(self::class,'create')]
    public function save(){
        $entity = Users::create($_POST);
        if($entity->save())
            header("Location: /users");
    }

    #[HttpPatch('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'update')]
    public function update(int $id){
        $entity = Users::findById($id);
        $entity->update($_POST);
        if($entity->save())
            header("Location: /users");
    }
//
//    #[HttpGet('/users/thrash')]
//    #[RoleBasedAccessMiddleware(self::class,'thrash')]
//    public function thrash(){
//        return "thrash";
//    }

    #[HttpDelete('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'delete')]
    public function delete(int $id){
        $entity = Users::findById($id);
        if($entity->delete())
             header('location: /users');
    }

//    #[HttpDelete('/users/:id/force-delete')]
//    #[RoleBasedAccessMiddleware(self::class,'force-delete')]
//    public function foreceDelete(){
//        return "about page";
//    }
//
//    #[HttpPatch('/users/:id/restore')]
//    #[RoleBasedAccessMiddleware(self::class,'restore')]
//    public function restore(){
//        return "about page";
//    }
}