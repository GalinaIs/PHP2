<?php
namespace app\models;
use \app\services\IDb as myIDb;

abstract class Model implements IModel {
    private $db;

    public function __construct(myIDb $db) {
        $this->db = $db;
    }

    public function getOne($id) {
        $table = $this->getTableName();
        $sql = "select * from {$table} where id={$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll() {
        $table = $this->getTableName();
        $sql = "select * from {$table}";
        return $this->db->queryAll($sql);
    }
}
?>