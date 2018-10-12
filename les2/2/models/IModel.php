<?php
namespace app\models;

interface IModel {
    public function saleProduct();
    public function calculateIncome();
    public function getCost();
}
?>