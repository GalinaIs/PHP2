<?php
namespace app\models;
use \app\services\DB as myDb;

abstract class Model implements IModel {
    private $db;

    public function __construct() {
        $this->db = myDb::getInstance();
    }

    public function getOne($id) {
        $table = $this->getTableName();
        $sql = "select * from {$table} where id=:id";
        return $this->db->queryOne($sql, [':id' => $id], get_class($this));
    }

    public function getAll() {
        $table = $this->getTableName();
        $sql = "select * from {$table}";
        return $this->db->queryAll($sql, [], get_class($this));
    }

    public function insertThis() {
        $table = $this->getTableName();
        $sql = "insert into {$table} (" . $this->getTableRow()  . ") values (" . $this->getTableValues() . ")";
        return $this->db->execute($sql, $this->getTableParams());
    }

    public function deleteThis() {
        $table = $this->getTableName();
        $sql = "delete from {$table} where id=:id";
        $id = $this->id;
        return $this->db->execute($sql, [':id' => $id]);
    }

    public function updateThis() {
        $table = $this->getTableName();
        $sql = "update {$table} set " . $this->getTableUpdate()  . " where id=:id";
        $params = $this->getTableParams();
        $params[':id'] = $this->id;
        return $this->db->execute($sql, $params);
    }
}
?>