<?php

namespace Framework\Middleware\Attributes;

use App\Models\Users;
use Framework\Container\Container;
use Framework\Core\Application;
use Framework\DatabaseHandler\Entity;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Middleware\AbstractHandler;
use Framework\Middleware\Interfaces\Handler;

#[\Attribute]
class AuthenticateMiddleware extends AbstractHandler implements Handler
{

    public function __construct()
    {
    }

    public function handle(): ?string
    {
        if (!isset($_SESSION['userID']) || empty(Users::findById(intval($_SESSION['userID']))))
            header("Location: /login");

        return parent::handle();
    }
}