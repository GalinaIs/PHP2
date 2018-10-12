<?php
namespace app\models;

class Order extends Model {
    public $id;
    public $idUser;
    public $idStatus;

    public function cancelOrder() {

    }

    public function getTableName() {
        return 'order_user';
    }
}
?>