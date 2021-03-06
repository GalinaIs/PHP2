<?php
namespace app\services;

interface IDb {
    public function queryOne(string $sql, array $params = []);
    public function queryAll(string $sql, array $params = []);
    public function queryObject($sql, $params = [], $className);
    public function queryAllObject($sql, $params = [], $className);
}