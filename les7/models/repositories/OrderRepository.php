<?php
namespace app\models\repositories;
use \app\models\Order as Order;
use \app\base\App as App;

class OrderRepository extends Repository {
    public function getTableName() {
        return 'order_user';
    }

    public function getEntityClass() {
        return Order::class;
    }

    public function getException() {
        return ['db', 'exception', 'id', 'image', 'name', 'price', 'cost', 'id_product', 'product_count'];
    }

    public function makeOrder($idUser) {
        $basketRep = App::call()->repository->basket;
        $cart = $basketRep->getBasket($idUser);

        $order = new Order();
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

    public function cancelOrder($idOrder) {
        $sql = 'UPDATE order_user SET id_status=5 where id=:id';
        static::getDb()->execute($sql, [':id' => $idOrder]);

        echo json_encode(['success' => 'ok', 'message' => 'Заказ успешно отменен!']);
    }
}
?>