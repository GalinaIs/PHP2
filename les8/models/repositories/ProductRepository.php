<?php
namespace app\models\repositories;
use \app\models\Product as Product;
use \app\base\App as App;

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

    public function addNewProduct($name, $price, $shortDesc, $fullDesc) {
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->short_description = $shortDesc;
        $product->full_description = $fullDesc;
        $this->save($product);

        $fileName = App::call()->files->
            uploadFile(App::call()->config['publicDir'] . 'image/products/full/', $error, 'file');
        if (!$error) {
            $sql = 'insert into image_products (path, products_id) values (:fileName, :idProduct)';
            static::getDb()->execute($sql, [
                ':fileName' => $fileName,
                ':idProduct' => $product->id
            ]);
            
            App::call()->resize->img_resize(App::call()->config['publicDir'] . 'image/products/full/' . $fileName, 
                App::call()->config['publicDir'] . 'image/products/min/' . $fileName, 150, 150);
        }
    }

    public function changeProduct($name, $price, $shortDesc, $fullDesc, $idProduct) {
        $product = new Product();
        $product->id = $idProduct;
        $product->name = $name;
        $product->price = $price;
        $product->short_description = $shortDesc;
        $product->full_description = $fullDesc;
        $this->save($product);
    }

    public function deleteProduct($id) {
        $sql = 'DELETE FROM products where id=:id';
        static::getDb()->execute($sql, [':id' => $id]);

        $sql = 'DELETE FROM image_products where products_id=:id';
        static::getDb()->execute($sql, [':id' => $id]);
    }
}
?>