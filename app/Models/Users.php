<?php

namespace App\Models;

use Framework\DatabaseHandler\Entity;
use Framework\Validator\Attributes\IntegerValidator;

class Users extends Entity
{

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var string
     */
    public string $roles = '[0]';
}