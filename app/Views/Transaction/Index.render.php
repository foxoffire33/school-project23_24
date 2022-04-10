<?php
$rootDiv = new \Framework\view\components\Body\Div('relative overflow-x-auto shadow-md sm:rounded-lg');
$table = new \Framework\view\components\Table\Table('w-full text-sm text-left text-gray-500 dark:text-gray-400');

$thead = new \Framework\view\components\Table\THead('text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400');

$tr = new \Framework\view\components\Table\Row();
$th = new \Framework\view\components\Table\Th('px-6 py-3', 'Name');
$tr->addLeave($th);

$th = new \Framework\view\components\Table\Th('px-6 py-3', 'Sale coin');
$tr->addLeave($th);


$th = new \Framework\view\components\Table\Th('px-6 py-3', 'amount');
$tr->addLeave($th);

$th = new \Framework\view\components\Table\Th('px-6 py-3', 'Buy coin');
$tr->addLeave($th);


$th = new \Framework\view\components\Table\Th('px-6 py-3', 'amount');
$tr->addLeave($th);

$thead->addLeave($tr);
$table->addLeave($thead);

$tbody = new \Framework\view\components\Table\TBody('bg-white border-b dark:bg-gray-800 dark:border-gray-700');
if(isset($data['models'])){
    foreach ($data['models'] as $model){
        $tr = new \Framework\view\components\Table\Row();
        $td = new \Framework\view\components\Table\Column('px-6 py-4',(\App\Models\Users::findById($model->user_id))->name);
        $tr->addLeave($td);

        $th = new \Framework\view\components\Table\Th('px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap',(\App\Models\Coin::findById($model->sale_coin))?->name);
        $tr->addLeave($th);

        $td = new \Framework\view\components\Table\Column('px-6 py-4',$model->sale_coin_amount);
        $tr->addLeave($td);

        $th = new \Framework\view\components\Table\Th('px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap',(\App\Models\Coin::findById($model->buy_coin))?->name);
        $tr->addLeave($th);

        $td = new \Framework\view\components\Table\Column('px-6 py-4',$model->buy_coin_amount);
        $tr->addLeave($td);

        $tbody->addLeave($tr);
    }
}


$table->addLeave($tbody);


?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Coin/TableOptions.render.php' ?>
<?= $table->render() ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>