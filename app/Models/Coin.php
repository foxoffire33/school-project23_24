<?php

namespace App\Models;

use App\Traits\SoftDelete;
use Framework\DatabaseHandler\Entity;

class Coin extends Entity
{

    use SoftDelete;

    public int $id = 0;
    public string $email;
    public string $name;
    public string $password;
}