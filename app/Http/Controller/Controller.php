<?php

namespace App\Http\Controller;

use Framework\AccessControl\AccessControl;
use Framework\database\MysqlConnection;
use Framework\Session\Session;
use Framework\Validator\Validator;
use Framework\view\View;

class Controller
{
    public function __construct(
        public View $view,
        public Validator $validator,
        public Session $session,
        public AccessControl $accessControl,
        public MysqlConnection $mysqlConnection
    )
    {
    }
}