<?php

namespace App\Http\Controller;

use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;

class DashboardController extends Controller
{
    #[HttpGet('/dashboard')]
    #[RoleBasedAccessMiddleware(self::class, 'index')]
    public function index()
    {
        return $this->view->resolve('Dashboard/Index');
    }
}