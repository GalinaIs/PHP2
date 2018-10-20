<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass;
    $controller->run($actionName);
}

//$product = new \app\models\Product();
/*$product = \app\models\Product::getOne(71);
$product->name = 'Штанишки';
$product->price = 350;
$product->save();*/
//var_dump($product);

/*$arrayProduct = \app\models\Product::getAll();
var_dump($arrayProduct);*/
/*$product = $product->getOne(2);
var_dump($product);*/
//var_dump($product->getAll());

/*$product->name = 'Ползунки';
$product->price = 300;
$product->short_description = 'Ползунки для Вашего карапуза';
$product->full_description = 'Наши ползунки изготовлены из натуральных тканей. Идеально подходят для малышей';
$product->save();
var_dump($product->id);*/
?>