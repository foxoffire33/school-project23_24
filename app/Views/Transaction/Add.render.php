<?php
$rootDiv = new \Framework\view\components\Body\Div('flex flex-wrap -mx-3 mb-6');

$form = new \Framework\view\components\Form\Form('/transactions/add', 'POST');

$div = new \Framework\view\components\Body\Div();
$div->addLeave(new \Framework\view\components\Form\InputField('buy_coin_amount', 'buy_coin_amount', 'number', ''));
$form->addLeave($div);

$form->addLeave(new \Framework\view\components\Form\InputField('user_id','user_id','hidden',$_SESSION['userID']));

$div = new \Framework\view\components\Body\Div('w-full');
$button = new \Framework\view\components\Form\Button('bg-black hover:bg-white text-white hover:text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3 w-full');
$div->addLeave($button);
$form->addLeave($div);



$rootDiv->addLeave($form);
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Coin/TableOptions.render.php' ?>
<?= $rootDiv->render() ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
