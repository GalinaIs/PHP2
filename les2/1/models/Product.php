<?php
namespace app\models;

class Product extends Model {
    public $id;
    public $name;
    public $description;
    public $price;
    public $producerId;

    public function getProductWithDiscount() {

    }

    public function getTableName() {
        return 'products';
    }
}
?>