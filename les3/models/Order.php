<?php
namespace app\models;

class Order extends Model {
    public $id;
    public $id_user;
    public $id_status;

    public function cancelOrder() {

    }

    public function getTableName() {
        return 'order_user';
    }

    public function getTableRow() {
        return 'name, price, short_description, full_description';
    }

    public function getTableValues() {
        return " :id_user, :id_status";
    }

    public function getTableUpdate() {
        return "id_user=:id_user, id_status=:id_status";
    }

    public function getTableParams() {
        return [
            ':id_user' => $this->id_user,
            ':id_status' => $this->id_status
        ];
    }
}
?>