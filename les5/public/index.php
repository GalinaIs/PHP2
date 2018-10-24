<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';  
include VENDOR_DIR . 'autoload.php';

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    //$controller = new $controllerClass(new \app\services\renderers\TemplateRenderer());
    $controller = new $controllerClass(new \app\services\renderers\TwigRenderer());
    $controller->run($actionName);
}
?>