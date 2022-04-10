<?php
$rootDiv = new \Framework\view\components\Body\Div('flex flex-wrap -mx-3 mb-6');

$form = new \Framework\view\components\Form\Form('/transactions', 'POST');

$selectCoin = array_map(fn($coin) => ['value' => $coin->id, 'text' => $coin->name], \App\Models\Coin::findAll());

$selectSaleCoin = new \Framework\view\components\Form\Select($selectCoin, 'sale_coin');
$selectBuyCoin = new \Framework\view\components\Form\Select($selectCoin, 'buy_coin');



$coinDiv = new \Framework\view\components\Body\Div('grid grid-flow-row-dense grid-cols-3 grid-rows-2');

$saleCoinLabelDiv = new \Framework\view\components\Body\Div();
$saleCoinLabelDiv->addLeave(new \Framework\view\components\Form\InputLabel('sale_coin','Sale'));

$saleAmountabelDiv = new \Framework\view\components\Body\Div();
$saleAmountabelDiv->addLeave(new \Framework\view\components\Form\InputLabel('sale_coin_amount','Amount'));

$BuyCoinLabelDiv = new \Framework\view\components\Body\Div();
$BuyCoinLabelDiv->addLeave(new \Framework\view\components\Form\InputLabel('buy_coin','Buy'));

$coinDiv->addLeave($saleCoinLabelDiv);
$coinDiv->addLeave($saleAmountabelDiv);
$coinDiv->addLeave($BuyCoinLabelDiv);


$coinSelectDiv = new \Framework\view\components\Body\Div();
$coinSelectDiv->addLeave($selectSaleCoin);
$coinDiv->addLeave($coinSelectDiv);

$coinSelectAmountDiv = new \Framework\view\components\Body\Div();
$coinSelectAmountDiv->addLeave(new \Framework\view\components\Form\InputNumber('sale_coin_amount','sale_coin_amount','0.0001'));
$coinDiv->addLeave($coinSelectAmountDiv);


$coinSelectDiv = new \Framework\view\components\Body\Div();
$coinSelectDiv->addLeave($selectBuyCoin);
$coinDiv->addLeave($coinSelectDiv);

$form->addLeave($coinDiv);

$div = new \Framework\view\components\Body\Div('w-full');
$button = new \Framework\view\components\Form\Button('bg-black hover:bg-white text-white hover:text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3 w-full');
$div->addLeave($button);

$form->addLeave($div);

$form->addLeave(new \Framework\view\components\Form\InputField('user_id','user_id','hidden',$_SESSION['userID']));


$rootDiv->addLeave($form);



?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Coin/TableOptions.render.php' ?>
<?= $rootDiv->render() ?>

<?php

?>

<?php $selectValues = array_map(fn($coin) => ['value' => $coin->id, 'text' => $coin->name], \App\Models\Coin::findAll()) ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
