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
    #[RoleBasedAccessMiddleware(self::class, 'login')]
    public function index()
    {
        return $this->view->resolve('Login/Index');
    }

    #[HttpPost('/login')]
    #[RoleBasedAccessMiddleware(self::class, 'login')]
    public function create()
    {
        if ($model = Users::findOne(['email' => $_POST['email']])) {
            if (password_verify($_POST['password'], $model->password)) {
                $this->session->set(Session::SESSION_USER_ID_KEY, $model->id);
                header("Location: /coins");
                return;
            }
            header("Location: /login");
        }
        $_SESSION['flash']['error'][] = "Invalid credentials.";
        header("Location: /login");
    }

    #[HttpPost('/logout')]
    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}