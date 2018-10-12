<?php
namespace app\models;
use \app\services\IDb as myIDb;

abstract class Model implements IModel {
    protected $sumAllSale;

    public function __construct() {
        $this->sumAllSale = 0;
    }

    public function saleProduct() {
        $cost = $this->getCost();
        $this->sumAllSale += $cost;
    }

    public function calculateIncome() {
        return 0.2 * $this->sumAllSale;
    }
}
?>