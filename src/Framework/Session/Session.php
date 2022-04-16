<?php

namespace Framework\Session;

use App\Models\Users;
use Framework\AccessControl\Exceptions\UserNotFoundException;
use Framework\core\Factories\SingletonFactory;
use Framework\DatabaseHandler\exceptions\RecordNotFoundException;
use http\Client\Curl\User;

class Session extends SingletonFactory
{

    const SESSION_USER_ID_KEY = 'userID';

    public static $flashMessages = [
        'information' => [],
        'success' => [],
        'warning' => [],
        'error' => []
    ];

    public ?Users $user = null;
    public ?string $csrf_token = null;

    public function __construct()
    {
        self::$flashMessages = $_SESSION['flash'];
        $user = Users::findById($_SESSION[self::SESSION_USER_ID_KEY]);
        if (!$user)
            $user = new Users();

        $this->user = $user;

        if (empty($_SESSION['csrf_token']))
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));

        $this->csrf_token = $_SESSION['csrf_token'];
    }
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
}