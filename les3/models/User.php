<?php
namespace app\models;

class User extends Model {
    public $id;
    public $login;
    public $password;
    public $name;

    public function getUserByRole() {

    }

    public function getTableName() {
        return 'users';
    }

    public function getTableRow() {
        return 'login, password, name';
    }

    public function getTableValues() {
        return ":login, :password, :name";
    }

    public function getTableUpdate() {
        return "login=:login, password=:password, name=:name";
    }

    public function getTableParams() {
        return [
            ':login' => $this->login,
            ':password' => $this->password,
            ':name' => $this->name
        ];
    }
}
?>