<?php
namespace app\models;

interface IModel {
    public function getOne($id);
    public function getAll();
    public function insertThis();
    public function deleteThis();
    public function updateThis();
    public function getTableName();
    public function getTableRow();
    public function getTableValues();
    public function getTableParams();
    public function getTableUpdate();
}
?>