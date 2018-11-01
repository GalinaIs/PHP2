<?php
namespace app\models;

class Product extends DataEntity {
    public $id;
    public $name = '';
    public $price = 0;
    public $short_description = '';
    public $full_description = '';
    public $image = '';
}
?>