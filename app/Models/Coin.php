<?php

namespace App\Models;

use Framework\database\Entity;

class Coin extends Entity
{
    /**
     * @var string
     */
    public int $id = 0;

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
}