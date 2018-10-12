<?php
namespace app\models;

class User extends Model {
    public $id;
    public $login;
    public $password;

    public function getUserByRole() {

    }

    public function getTableName() {
        return 'users';
    }
}
?>