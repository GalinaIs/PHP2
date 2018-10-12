<?php
namespace app\models;

class PieceProduct extends Model {
    private $cost;

    public function __construct() {
        parent::__construct();
        $this->cost = 30;
    }

    public function getCost() {
        return $this->cost;
    }
}
?>