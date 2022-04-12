<?php

namespace App\Models;

use App\Traits\SoftDelete;
use Framework\DatabaseHandler\Entity;
use Framework\Validator\Attributes\IntegerValidator;
use Framework\Validator\Attributes\StringValidator;

class Users extends Entity
{

    use SoftDelete;

    public string $email;
    public string $name;
    public string $password;
    public string $roles = '[0]';
}