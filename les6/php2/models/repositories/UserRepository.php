<?php
namespace app\models\repositories;
use \app\models\User as User;

class UserRepository extends Repository {
    public function getTableName() {
        return 'users';
    }

    public function getEntityClass() {
        return User::class;
    }

    protected function getException() {
        return ['db', 'exception', 'id'];
    }
}
?>