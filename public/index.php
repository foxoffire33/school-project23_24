<?php
error_reporting(E_ERROR | E_PARSE);
require_once __DIR__ . './../vendor/autoload.php';


$container = new \Framework\Container\Container();

$app = new \Framework\Core\Application($container);
?>
<?= $app->repsonse() ?>
