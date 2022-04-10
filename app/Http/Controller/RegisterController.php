<?php

namespace App\Http\Controller;

use App\Models\Users;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPost;
use Framework\view\View;

class RegisterController extends Controller
{
    #[HttpGet('/register')]
    #[RoleBasedAccessMiddleware(self::class,'register')]
    public function index()
    {
        return $this->view->resolve('Register/Index');
    }

    #[HttpPost('/register')]
    #[RoleBasedAccessMiddleware(self::class,'register')]
    public function create(){
        $passwordHash = password_hash($_POST['password'],PASSWORD_DEFAULT);
        if((Users::create(array_merge($_POST,['password' => $passwordHash])))->save())
            header("Location: /register");
    }
}