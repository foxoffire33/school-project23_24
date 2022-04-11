<?php

namespace App\Http\Controller;

use App\Models\Transaction;
use Framework\Core\Application;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Middleware\Attributes\AuthenticateMiddleware;
use Framework\Middleware\Attributes\RoleBasedAccessMiddleware;
use Framework\Router\Attributes\HttpGet;
use Framework\Router\Attributes\HttpPost;
use Framework\view\View;

class TransactionController extends Controller
{
    #[HttpGet('/transactions')]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'index')]
    public function index(): ?string
    {
        return $this->view->resolve('Transaction/Index',['models' => Transaction::findAll()]);
    }

    #[HttpGet('/transactions/create')]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'create')]
    public function create(): ?string{
        return $this->view->resolve('Transaction/BuyOrSale');
    }

    #[HttpPost('/transactions')]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'save')]
    public function save(): ?string{
        $model = Transaction::create($_POST);
        $validated = $this->validator->validated($model);

        //todo uitzoeken wat hier mis gaat
        //$this->mysqlConnection->call('TradeCoin',$validated);
        $rawQuery = $this->mysqlConnection->query('call TradeCoin(' .  implode(',',$validated) . ');');
        if($rawQuery)
            header("Location: /walled");

        return null;
    }

    #[HttpGet('/transactions/add')]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'add')]
    public function add(): ?string{
       return $this->view->resolve('Transaction/Add');
    }

    #[HttpPost('/transactions/add')]
    #[AuthenticateMiddleware]
    #[RoleBasedAccessMiddleware(self::class,'addPost')]
    public function addPost(): ?string {
        $model = Transaction::create(array_merge(['buy_coin' => 1],$_POST));
        if(!empty($this->validator->validated($model)) && $model->save())
            header("Location: /walled");

        return null;
    }
}