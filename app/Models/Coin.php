<?php

namespace App\Models;

use App\Traits\SoftDelete;
use Framework\DatabaseHandler\Entity;

class Coin extends Entity
{

    use SoftDelete;

    public ?int $id = null;
    public string $short_name, $name;
    public float $value;
}