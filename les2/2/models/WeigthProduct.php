<?php
namespace app\models;

class WeigthProduct extends Model {
    private $cost;
    private $weigth;
    
    public function __construct() {
        parent::__construct();
        $this->cost = 50;
        $this->weigth = 0;
    }

    public function getCost() {
        return $this->weigth * $this->cost;
    }

    public function setWeigth($weigth) {
        $this->weigth = $weigth;
    }

    public function getWeigth() {
        return $this->weigth;
    }
}
?>