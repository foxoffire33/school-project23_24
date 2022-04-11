<?php

namespace Framework\Session;

use App\Models\Users;
use Framework\AccessControl\Exceptions\UserNotFoundException;
use Framework\DatabaseHandler\exceptions\RecordNotFoundException;
use http\Client\Curl\User;

class Session
{

    const SESSION_USER_ID_KEY = 'userID';

    private $flashMessages = [
        'information' => [],
        'success' => [],
        'warning' => [],
        'error' => []
    ];

    public ?Users $user = null;

    public function __construct()
    {
        try {
            $user = Users::findById($_SESSION[self::SESSION_USER_ID_KEY]);
        } catch (RecordNotFoundException $exception) {
            //Als ik een RecordNotFoundException krijg dan is de gebruiker niet gevonden, Zet de gebruiker dan gelijkt aan een guest user
            $user = new Users();
        }
        $this->user = $user;
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
}