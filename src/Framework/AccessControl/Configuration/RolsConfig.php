<?php

namespace Framework\AccessControl;

use App\Http\Controller\AuthenticateController;
use App\Http\Controller\CoinController;
use App\Http\Controller\RegisterController;
use App\Http\Controller\SiteController;
use App\Http\Controller\TransactionController;
use App\Http\Controller\UsersController;
use App\Http\Controller\WalledController;

return [
    AccessControl::ROLES_ORDER_KEY_NAME => ['guest', 'authenticated', 'administrator'],
    AccessControl::USER_ROLES_KEY_NAME => [
        'guest' => 0,
        'authenticated' => 1,
        'administrator' => 2
    ],
    AccessControl::ROLES_ACTIONS_KEY_NAME => [
        'guest' => [
            SiteController::class => ['index', 'contact'],
            AuthenticateController::class => ['login'],
            RegisterController::class => ['register']
        ],
        'authenticated' => [
            SiteController::class => ['index', 'contact'],
            AuthenticateController::class => ['logout'],
            CoinController::class => ['index', 'show'],
            TransactionController::class => ['create', 'save', 'add', 'addPost'],
            WalledController::class => 'index',
        ],
        'administrator' => [
            SiteController::class,
            AuthenticateController::class,
            CoinController::class,
            TransactionController::class,
            WalledController::class,
            UsersController::class
        ]
    ]
];