<?php
namespace app\models\repositories;
use \app\services\DB as myDb;
use \app\models\DataEntity as DataEntity;
use \app\base\App as App;

abstract class Repository implements IRepository {
    protected $db;

    public function __construct() {
        $this->db = static::getDb();
    }

    public function getOne($id) {
        $table = $this->getTableName();
        $sql = "select * from {$table} where id=:id";
        return static::getDb()->queryObject($sql, [':id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $table = $this->getTableName();
        $sql = "select * from {$table}";
        return static::getDb()->queryAllObject($sql, [], $this->getEntityClass());
    }

    private function insert(DataEntity $entity) {
        $table = $this->getTableName();
        $columns = [];
        $params = [];
        $exception = $this->getException();
        foreach ($entity as  $key => $value) {
            if (in_array($key, $exception)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "{$key}";
        }

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";
        static::getDb()->execute($sql, $params);
        $entity->id = static::getDb()->lastInsertId();
    }

    public function delete(DataEntity $entity) {
        $table = $this->getTableName();
        $sql = "delete from {$table} where id=:id";
        return static::getDb()->execute($sql, [':id' => $entity->id]);
    }

    private function update(DataEntity $entity) {
        $table = $this->getTableName();  
        $product = $this->getOne($entity->id);
        
        $values = [];
        $params = [];
        $exception = $this->getException();
        foreach ($entity as  $key => $value) {
            if (in_array($key, $exception)) {
                continue;
            }

            if ($product->$key != $entity->$key) {
                $params[":{$key}"] = $value;
                $values[] = "{$key} = :{$key}";
            }
        }

        $values = implode(', ', $values);
        $params[':id'] = $entity->id;
        if ($values != '') {
            $sql = "update {$table} set {$values} where id=:id";
            static::getDb()->execute($sql, $params);
        }
    }

    public function save(DataEntity $entity) {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    protected static function getDb() {
        return App::call()->db;
    }
}
?>