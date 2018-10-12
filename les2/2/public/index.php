<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$dProduct = new \app\models\DigitalProduct();
var_dump($dProduct);
echo("Стоимость 1 устройства равна " . $dProduct->getCost()) . ' рублей<br>';
//var_dump($dProduct->getCost());
$dProduct->saleProduct();
$dProduct->saleProduct();
$dProduct->saleProduct();
echo("Доход от продажи товара: " . $dProduct->calculateIncome()) . ' рублей<br>';

$pProduct = new \app\models\PieceProduct();
var_dump($pProduct);
echo("Стоимость 1 товара равна " . $pProduct->getCost()) . ' рублей<br>';
$pProduct->saleProduct();
$pProduct->saleProduct();
echo("Доход от продажи товара: " . $pProduct->calculateIncome()) . ' рублей<br>';

$wProduct = new \app\models\WeigthProduct();
var_dump($wProduct);
$wProduct->setWeigth(0.1);
echo("Стоимость " . $wProduct->getWeigth() . " грамм товара равна " . $wProduct->getCost()) . ' рублей<br>';
$wProduct->saleProduct();
$wProduct->setWeigth(1);
$wProduct->saleProduct();
$wProduct->setWeigth(1.5);
$wProduct->saleProduct();
echo("Доход от продажи товара: " . $wProduct->calculateIncome()) . ' рублей<br>';
?>