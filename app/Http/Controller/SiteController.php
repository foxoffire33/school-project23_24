<?php

namespace App\Http\Controller;

use Framework\DatabaseHandler\MysqlConnection;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;
use Framework\Validator\Validator;
use Framework\view\components\Body\Div;
use Framework\view\components\Form\Form;
use Framework\view\components\Form\InputField;
use Framework\view\components\Form\TextField;
use Framework\view\View;

class SiteController extends Controller
{

    #[HttpGet('/')]
    #[RoleBasedAccessMiddleware(self::class,'index')]
    public function index(): ?string
    {

        //var_dump($this->view->render('Site/Home'));
         return $this->view->resolve('Site/Home');
    }

    #[HttpGet('/about')]
    #[RoleBasedAccessMiddleware(self::class,'about')]
    public function about(): ?string
    {
        return "about page";
    }

    #[HttpGet('/contact')]
    #[RoleBasedAccessMiddleware(self::class,'contact')]
    public function contact(): ?string
    {
        return $this->view->resolve('Site/Contact');
    }
}