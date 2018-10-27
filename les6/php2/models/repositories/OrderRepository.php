<?php
namespace app\models\repositories;
use \app\models\Order as Order;

class OrderRepository extends Repository {
    public function getTableName() {
        return 'order_user';
    }

    public function getEntityClass() {
        return Order::class;
    }

    public function getException() {
        return ['db', 'exception', 'id'];
    }

    public function makeOrder($idUser) {
        $basketRep = new \app\models\repositories\BasketRepository();
        $cart = $basketRep->getBasket($idUser);

        $order = new \app\models\Order();
        $order->id_user = $idUser;
        $order->id_status = 1;
        $this->save($order);

        foreach ($cart as $oneProductCart) {
            $sql = 'insert into order_full_info (id_product, product_count, id_order) values (:id_product, :product_count, :id_order)';
            static::getDb()->execute($sql, [
                ':id_product' => $oneProductCart->id_product,
                ':product_count' => $oneProductCart->count,
                ':id_order' => $order->id
            ]);
        }

        $basketRep->clearBasket($idUser);
    }
}
?>