<?php
namespace app\models;

class Order extends DataEntity {
    public $id;
    public $id_user;
    public $id_status;
    public $id_product;
    public $name;
    public $price;
    public $product_count;
    private $cost;
    public $image;

    public function calculateCost() {
        $this->cost = $this->price * $this->product_count;
    }

    public function getCost() {
        return $this->cost;
    }
}
?>