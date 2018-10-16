<?php
namespace app\models;

class Product extends Model {
    public $id;
    public $name = '';
    public $price = 0;
    public $short_description = '';
    public $full_description = '';

    public function getProductWithDiscount() {

    }

    public function getTableName() {
        return 'products';
    }

    public function getTableRow() {
        return 'name, price, short_description, full_description';
    }

    public function getTableValues() {
        return ":name, :price, :short_description, :full_description";
    }

    public function getTableUpdate() {
        return "name=:name, price=:price, short_description=:short_description, full_description=:full_description";
    }

    public function getTableParams() {
        return [
            ':name' => $this->name,
            ':price' => $this->price,
            ':short_description' => $this->short_description,
            ':full_description' => $this->full_description,
        ];
    }
}
?>