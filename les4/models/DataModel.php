<?php
namespace app\models;
use \app\services\DB as myDb;

abstract class DataModel implements IDataModel {
    protected $db;
    private $exception = ['db', 'exception', 'id', 'image'];

    public function __construct() {
        $this->db = myDb::getInstance();
    }

    public static function getOne($id) {
        $table = static::getTableName();
        $sql = "select * from {$table} where id=:id";
        return myDb::getInstance()->queryObject($sql, [':id' => $id], get_called_class());
    }

    public static function getAll() {
        $table = static::getTableName();
        $sql = "select * from {$table}";
        return myDb::getInstance()->queryAllObject($sql, [], get_called_class());
    }

    private function insert() {
        $table = $this->getTableName();
        $columns = [];
        $params = [];
        foreach ($this as  $key => $value) {
            if (in_array($key, $this->exception)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "{$key}";
        }

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function delete() {
        $table = $this->getTableName();
        $sql = "delete from {$table} where id=:id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    private function update() {
        $table = $this->getTableName();  
        $product = static::getOne($this->id);
        
        $values = [];
        $params = [];
        foreach ($this as  $key => $value) {
            if (in_array($key, $this->exception)) {
                continue;
            }

            if ($product->$key != $this->$key) {
                $params[":{$key}"] = $value;
                $values[] = "{$key} = :{$key}";
            }
        }

        $values = implode(', ', $values);
        $params[':id'] = $this->id;
        if ($values != '') {
            $sql = "update {$table} set {$values} where id=:id";
            $this->db->execute($sql, $params);
        }
    }

    public function save() {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }
}
?>