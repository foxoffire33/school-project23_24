<?php

namespace App\Models;

use App\Traits\SoftDelete;
use Framework\DatabaseHandler\Entity;
use Framework\Validator\Attributes\ExistsValidator;
use Framework\Validator\Attributes\FloatValidator;
use Framework\Validator\Attributes\IntegerValidator;
use Framework\Validator\Attributes\NotEqualValidator;

class Transaction extends Entity
{
    use SoftDelete;

    public ?int $id = null;

    #[IntegerValidator]
    #[NotEqualValidator('buy_coin')]
    #[ExistsValidator(Coin::class)]
    public ?int $sale_coin = null;

    #[FloatValidator]
    public ?float $sale_coin_amount = null;

    #[IntegerValidator]
    public ?int $buy_coin = null;

    #[FloatValidator]
    public ?float $buy_coin_amount = null;

    #[IntegerValidator]
    #[ExistsValidator(Users::class)]
    public ?int $user_id = null;
}