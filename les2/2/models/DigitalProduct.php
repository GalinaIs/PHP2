<?php
namespace app\models;

class DigitalProduct extends Model {
    private $cost;

    public function __construct() {
        parent::__construct();
        $this->cost = 15;
    }

    public function getCost() {
        return $this->cost;
    }
}
?>