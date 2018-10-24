<?php
namespace app\models;

class Order extends DataModel {
    public $id;
    public $id_user;
    public $id_status;

    public function cancelOrder() {

    }

    public static function getTableName() {
        return 'order_user';
    }
}
?>