<?php
namespace app\models\repositories;
use \app\models\Basket as Basket;
use \app\models\Product as Product;
use \app\models\DataEntity as DataEntity;

class BasketRepository extends Repository {
    public function getTableName() {
        return 'basket';
    }

    public function getEntityClass() {
        return Basket::class;
    }

    public function getException() {
        return ['db', 'exception', 'id', 'image', 'name', 'price', 'cost'];
    }

    public function getOneIdProduct($idProduct, $idUser) {
        $sql = "select * from basket where id_product=:id AND id_user=:id_user";
        return static::getDb()->queryObject($sql, [
            ':id' => $idProduct,
            ':id_user' => $idUser
        ], $this->getEntityClass());
    }

    private function addItem($idProduct, $count, $idUser) {
        $item = $this->getOneIdProduct($idProduct, $idUser);
        if ($item) {
            $item->count += $count;
        } else {
            $item = new Basket();
            $item->id_product = $idProduct;
            $item->id_user = $idUser;
            $item->count = $count;
        }
        $this->save($item);
        return $item;
    }

    private function changeItem($idProduct, $count, $idUser) {
        $item = $this->getOneIdProduct($idProduct, $idUser);
        $item->count = $count;
        $this->save($item);
    }

    private function deleteItem($idProduct, $idUser) {
        $sql = 'delete from basket where id_product=:id AND id_user=:id_user';
        static::getDb()->execute($sql, [
            ':id' => $idProduct,
            ':id_user' => $idUser
        ]);
    }

    public function changeBasket($action, $idProduct, $count, $idUser) {
        switch ($action) {
            case 'add': 
                $item = $this->addItem($idProduct, $count, $idUser);
                break;
            case 'change':
                $this->changeItem($idProduct, $count, $idUser);
                break;
            case 'delete':
                $this->deleteItem($idProduct, $idUser);    
                break;
        }
        return $item;
    }

    public function getBasket($idUser) {
        $sql = 'select * from basket where id_user=:id_user';
        return static::getDb()->queryAllObject($sql, [':id_user' => $idUser], $this->getEntityClass());
    }

    public function getFullBasket($idUser) {
        $cart = $this->getBasket($idUser);
        
        foreach($cart as $oneProductCart) {
            $sql = 'select* from products where id=:id';
            $oneProduct = static::getDb()->queryObject($sql, [':id' => $oneProductCart->id_product], Product::class);
            $oneProduct = (new ProductRepository())->getOneImage($oneProduct);

            $oneProductCart->image = $oneProduct->image;
            $oneProductCart->name = $oneProduct->name;
            $oneProductCart->price = $oneProduct->price;
            $oneProductCart->calculateCost();
        }
    
        return $cart;
    }

    public function getCost($cart) {
        $cost = 0;
        foreach($cart as $oneProductCart) {
            $cost += $oneProductCart->getCost();
        }
        return $cost;
    }

    public function clearBasket($idUser) {
        $sql = 'delete from basket where id_user=:id_user';
        static::getDb()->execute($sql, [':id_user' => $idUser]);
    }
}
?>