<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';  
include VENDOR_DIR . 'autoload.php';
use \app\models\Basket as BasketModel;


/*$product = new \app\models\Product();
$product = (new app\models\repositories\ProductRepository())->getOne(72);
var_dump($product);*/
/*$product->name = 'Позунки для малышей';*/
/*(new app\models\repositories\ProductRepository())->save($product);*/
/*$basketRep = new app\models\repositories\BasketRepository();
$idProduct = 27;
$item = $basketRep->getOne($idProduct);
var_dump($item);
$count = 1;
if (isset($item->id)) {
    var_dump(1);
    $item->count += $count;
} else {
    $item = new BasketModel();
    $item->id_product = $idProduct;
    $item->count = $count;
}
$basketRep->save($item);
*/
/*$product->name = 'Ползунки';
$product->price = 300;
$product->short_description = 'Ползунки для Вашего карапуза';
$product->full_description = 'Наши ползунки изготовлены из натуральных тканей. Идеально подходят для малышей';
(new app\models\repositories\ProductRepository())->save($product);
var_dump($product->id);*/

$request = new \app\services\request\Request();
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $repositoryClass = REPOSITORY_NAMESPACE . "\\" . ucfirst($controllerName) . "Repository";
    $controller = new $controllerClass(new \app\services\renderers\TemplateRenderer(), new $repositoryClass(), $request);
    try {
        $controller->run($actionName);
    } catch (\Exception $e) {
        (new \app\controllers\ErrorController(new \app\services\renderers\TemplateRenderer()))->actionIndex($e->getMessage());
    }
    
}
?>