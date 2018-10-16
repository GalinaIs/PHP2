<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$product = new \app\models\Product();
$product->name = 'Ползунки';
$product->price = 300;
$product->short_description = 'Ползунки для Вашего карапуза';
$product->full_description = 'Наши ползунки изготовлены из натуральных тканей. Идеально подходят для малышей';
$product->insertThis();

$order = new \app\models\Order();
$order->id = 11;
$order->id_user = 2;
$order->id_status = 5;
$order->updateThis();

$user = new \app\models\User();
$user->id = 8;
$user->deleteThis();
?>