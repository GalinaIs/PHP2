<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$db = new \app\services\Db();
var_dump($db);
$product = new \app\models\Product($db);
var_dump($product);
$order = new \app\models\Order($db);
var_dump($order);
?>