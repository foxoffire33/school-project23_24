<?php

namespace App\Http\Controller;

use App\Models\Users;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPost;
use Framework\Session\Session;
use Framework\view\View;

class AuthenticateController extends Controller
{
    #[HttpGet('/login')]
    #[RoleBasedAccessMiddleware(self::class,'login')]
    public function index()
    {
        $this->view->resolve('Login/Index');
    }

    #[HttpPost('/login')]
    #[RoleBasedAccessMiddleware(self::class,'login')]
    public function create(){
        if($model = Users::findOne(['email' => $_POST['email']])){
            if(password_verify($_POST['password'],$model->password)){
                $this->session->set(Session::SESSION_USER_ID_KEY, $model->id);
                return header("Location: /transactions");
            }
            $_SESSION['flash']['error'][] = "Invalied cerdentials";
            return header("Location: /login");
        }
            return header("Location: /coins");
    }

    #[HttpGet('/logout')]
    public function logout(){
        session_destroy();
        header("Location: /");
    }
}