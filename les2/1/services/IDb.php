<?php
namespace app\services;

interface IDb {
    public function queryOne($sql);
    public function queryAll($sql);
}