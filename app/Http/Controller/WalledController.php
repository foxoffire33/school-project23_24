<?php

namespace App\Http\Controller;

use App\Models\Walled;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\Middleware\Attributes\ThrottleMiddleware;
use Framework\Router\Attributes\HttpGet;

class WalledController extends Controller
{
    #[HttpGet('/walled')]
    #[ThrottleMiddleware(120, 60)]
    #[AuthenticateMiddleware]
    public function index(): ?string
    {
        return $this->view->resolve('Walled/Index', [
            'models' => Walled::findAll(['user_id' => $this->session->user->id]),
            'session' => $this->session
        ]);
    }
}