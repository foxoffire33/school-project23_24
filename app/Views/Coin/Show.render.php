<?php
$rootDiv = new \Framework\view\components\Body\Div('relative overflow-x-auto shadow-md sm:rounded-lg');
$table = new \Framework\view\components\Table\Table('w-full text-sm text-left text-gray-500 dark:text-gray-400');
$rootDiv->addLeave($table);


?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Coin/TableOptions.render.php' ?>
<?= $table->render() ?>
    <h1>Show coin <?= $model->short_name ?></h1>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>