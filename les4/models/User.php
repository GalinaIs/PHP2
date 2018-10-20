<?php
namespace app\models;

class User extends DataModel {
    public $id;
    public $login;
    public $password;
    public $name;

    public function getUserByRole() {

    }

    public static function getTableName() {
        return 'users';
    }
}
?>