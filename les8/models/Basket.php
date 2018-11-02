<?php
namespace app\models;

class Basket extends DataEntity {
    public $id;
    public $id_product;
    public $id_user;
    public $count;
    public $name;
    public $price;
    private $cost;
    public $image;

    public function calculateCost() {
        $this->cost = $this->price * $this->count;
    }

    public function getCost() {
        return $this->cost;
    }
}
?>