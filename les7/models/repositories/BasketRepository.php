<?php
namespace app\models\repositories;
use \app\models\Basket as Basket;
use \app\models\Product as Product;
use \app\models\DataEntity as DataEntity;
use \app\base\App as App;

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
        if (isset($idUser)) {
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
        } else {
            if (App::call()->session->get('basket') == null) {
                App::call()->session->set('basket', []);
            }

            $basket = App::call()->session->get('basket');
            $key = array_search($idProduct, array_column($basket, 'id'));

            if ($key === FALSE) {
                $basket[] =  ['id' => $idProduct, 'qty' => $count];
            } else {
                $basket[$key]['qty'] += (int)$count;
            }
            App::call()->session->set('basket', $basket);
        }
    }

    private function changeItem($idProduct, $count, $idUser) {
        if (isset($idUser)) {
            $item = $this->getOneIdProduct($idProduct, $idUser);
            $item->count = $count;
            $this->save($item);
        } else {
            $basket = App::call()->session->get('basket');
            $key = array_search($idProduct, array_column($basket, 'id'));

            $basket[$key]['qty'] = (int)$count;
            App::call()->session->set('basket', $basket);
        }
        
    }

    private function deleteItem($idProduct, $idUser) {
        if (isset($idUser)){
            $sql = 'delete from basket where id_product=:id AND id_user=:id_user';
            static::getDb()->execute($sql, [
                ':id' => $idProduct,
                ':id_user' => $idUser
            ]);
            } else {
                $basket = App::call()->session->get('basket');
                $key = array_search($idProduct, array_column($basket, 'id'));
                array_splice($basket, $key, 1);
                App::call()->session->set('basket', $basket);
            }
    }

    public function changeBasket($action, $idProduct, $count, $idUser) {
        switch ($action) {
            case 'add': 
                $this->addItem($idProduct, $count, $idUser);
                break;
            case 'change':
                $this->changeItem($idProduct, $count, $idUser);
                break;
            case 'delete':
                $this->deleteItem($idProduct, $idUser);    
                break;
        }
    }

    public function getBasket($idUser) {
        if (isset($idUser)) {
            $sql = 'select * from basket where id_user=:id_user';
            return static::getDb()->queryAllObject($sql, [':id_user' => $idUser], $this->getEntityClass());
        } else {
            if ($basket = App::call()->session->get('basket')) {
                $basketModelArray = [];
                foreach ($basket as $oneItem) {
                    $oneBasket = new Basket();
                    $oneBasket->id_product = $oneItem['id'];
                    $oneBasket->count = $oneItem['qty'];
                    $basketModelArray[] = $oneBasket;
                }
                return $basketModelArray;
            } else {
                App::call()->session->set('basket', []);
                return [];
            }
        }
    }

    public function getFullBasket($idUser) {
        $cart = $this->getBasket($idUser);
        
        foreach($cart as $oneProductCart) {
            $sql = 'select* from products where id=:id';
            $oneProduct = static::getDb()->queryObject($sql, [':id' => $oneProductCart->id_product], Product::class);
            $oneProduct = App::call()->repository->product->getOneImage($oneProduct);

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

    public function createBasketNewUser($idUser) {
        $basket = App::call()->session->get('basket');
        foreach ($basket as $oneItem) {
            $sql = 'insert into basket (id_product, count, id_user) values (:id_product, :count, :id_user)';
            static::getDb()->execute($sql, [
                ':id_product' => $oneItem['id'],
                ':count' => $oneItem['qty'],
                ':id_user' => $idUser
            ]);
        }
        App::call()->session->set('basket', []);
    }
}
?>