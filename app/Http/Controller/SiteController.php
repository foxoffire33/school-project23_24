<?php

namespace App\Http\Controller;

use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;

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