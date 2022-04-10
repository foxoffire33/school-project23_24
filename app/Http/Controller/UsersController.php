<?php

namespace App\Http\Controller;

use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpDelete;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPath;
use Framework\Router\Attributes\HttpPost;
use Framework\router\HttpRequest;

class UsersController extends Controller
{


    #[HttpGet('/users/')]
    #[RoleBasedAccessMiddleware(self::class,'index')]
    public function index(HttpRequest $request){
        var_dump($request);
        return "Home";
    }

    #[HttpGet('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'show')]
    public function show(){
        return "Home";
    }

    #[HttpPath('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'update')]
    public function update(){
        return "with id page";
    }

    #[HttpGet('/users/thrash')]
    #[RoleBasedAccessMiddleware(self::class,'thrash')]
    public function thrash(){
        return "thrash";
    }

    #[HttpDelete('/users/:id')]
    #[RoleBasedAccessMiddleware(self::class,'delete')]
    public function delete(){
        return "delete wirh is page";
    }

    #[HttpDelete('/users/:id/force-delete')]
    #[RoleBasedAccessMiddleware(self::class,'force-delete')]
    public function foreceDelete(){
        return "about page";
    }

    #[HttpPath('/users/:id/restore')]
    #[RoleBasedAccessMiddleware(self::class,'restore')]
    public function restore(){
        return "about page";
    }
}