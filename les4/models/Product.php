<?php
namespace app\models;
use \app\services\DB as myDb;

class Product extends DataModel {
    public $id;
    public $name = '';
    public $price = 0;
    public $short_description = '';
    public $full_description = '';
    public $image = '';

    public function getAllImage() {
        $sql = 'select * from image_products where products_id=:id';
        $allImages = $this->db->queryAll($sql, [':id' => $this->id]);
        return array_column($allImages, 'path');
    }

    public function getOneImage() {
        $sql = 'select * from image_products where products_id=:id';
        $this->image = $this->db->queryOne($sql, [':id' => $this->id])['path'];
    }

    public static function getTableName() {
        return 'products';
    }
}
?>