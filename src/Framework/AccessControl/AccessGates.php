<?php

namespace Framework\AccessControl;

use App\Models\Users;
use Framework\database\Entity;
use Framework\Middleware\HttpUnauthorizedException;

class AccessGates
{
    private array $gates = [];

    public function __construct()
    {
        $this->gates['createdByUser'] = fn($user, $model) => $user->id == $model->user_id;
    }

    public function execute(string $key, Users $user, Entity $entity): void
    {
        $execute = $this->gates[$key];
        if (!is_callable($execute) || !($execute($user, $entity)))
            throw new HttpUnauthorizedException();
    }
}