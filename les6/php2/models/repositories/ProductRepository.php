<?php
namespace app\models\repositories;
use \app\models\Product as Product;

class ProductRepository extends Repository {
    public function getTableName() {
        return 'products';
    }

    public function getEntityClass() {
        return Product::class;
    }

    public function getException() {
        return ['db', 'exception', 'id', 'image'];
    }

    public function getAllImage(Product $product) {
        $sql = 'select * from image_products where products_id=:id';
        $allImages = static::getDb()->queryAll($sql, [':id' => $product->id]);
        return array_column($allImages, 'path');
    }

    public function getOneImage(Product $product) {
        $sql = 'select * from image_products where products_id=:id';
        $product->image = static::getDb()->queryOne($sql, [':id' => $product->id])['path'];
        return $product;
    }
}
?>