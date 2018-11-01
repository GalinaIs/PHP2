<?php
namespace app\models\repositories;
use \app\models\User as User;
use \app\models\Order as Order;

class UserRepository extends Repository {
    public function getTableName() {
        return 'users';
    }

    public function getEntityClass() {
        return User::class;
    }

    public function getException() {
        return ['db', 'exception', 'id'];
    }

    public function getUserByLoginPass($login, $password) {
        $sql ='select * from users where login=:login and password=:password';
        return static::getDb()->queryObject($sql, [
            ':login' => $login,
            ':password' => $password
        ], User::class);
    }

    public function resultUserRegistration($login, $password, $name) {
        $user = $this->getUserByLoginPass($login, $password);
        if (!is_null($user)) {
            return false;
        }

        $sql = 'insert into users (login, password, name) values (:login, :password, :name)';
        static::getDb()->execute($sql, [
            ':login' => $login,
            ':password' => $password,
            ':name' => $name
        ]);
        return true;
    }

    public function getOrdersByUserId($userId) {
        $sql = 'select * from order_user where id_user=:user_id';
        $allOrders = static::getDb()->queryAllObject($sql, [':user_id' => $userId], Order::class);
        $fullInfoOrders = [];

        foreach ($allOrders as $oneOrder) {
            $sql = 'select * from order_full_info inner join products on products.id=order_full_info.id_product where id_order=:id_order';
            $order = static::getDb()->queryAllObject($sql, [':id_order' => $oneOrder->id], Order::class);
            foreach ($order as $orderItem) {
                $orderItem->calculateCost();
                $sql = 'select * from image_products where products_id=:id';
                $orderItem->image = static::getDb()->queryOne($sql, [':id' => $orderItem->id_product])['path'];
            }
            
            $sql = 'select * from status_order where id=:id';
            $state = static::getDb()->queryOne($sql, [':id' => $oneOrder->id_status])['status'];
            $cost = $this->getCost($order);
            $fullInfoOrders[] = ['order' => $order, 'state' => $state, 'cost' => $cost, 'id_status' => $oneOrder->id_status, 'id' => $oneOrder->id];
        }

        return $fullInfoOrders;
    }

    public function getCost($order) {
        $cost = 0;
        foreach($order as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}
?>