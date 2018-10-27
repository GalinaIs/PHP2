<?php
namespace app\models\repositories;
use \app\models\DataEntity as DataEntity;

interface IRepository {
    public function getOne($id);
    public function getAll();
    public function getTableName();
    public function save(DataEntity $entity);
    public function delete(DataEntity $entity);
    public function getEntityClass();
    public function getException();
}
?>