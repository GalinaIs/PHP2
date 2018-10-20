<?php
namespace app\models;

interface IDataModel {
    public static function getOne($id);
    public static function getAll();
    public static function getTableName();
    public function save();
    public function delete();
}
?>