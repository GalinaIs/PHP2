<?php
namespace app\services;

class Db implements IDb {
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'Shop_Nastasya',
        'charset' => 'utf8'
    ];
    protected $conn = null;

    use \app\traits\TSingletone;

    private function getConnection() {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(), 
                $this->config['login'], 
                $this->config['password']
            );
        }
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_CLASS);
        return $this->conn;
    }

    private function query(string $sql, array $params = []) {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    private function prepareDsnString():string {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function execute(string $sql, array $params = []) {
        return $this->query($sql, $params);
    }

    public function queryOne(string $sql, array $params = [], string $className = '') {
        return $this->queryAll($sql, $params, $className)[0];
    }

    public function queryAll(string $sql, array $params = [], string $className = '') {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $pdoStatement->fetchAll();
    }
}