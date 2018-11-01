<?php
namespace app\services;

class Db implements IDb {
    private $config = [];
    protected $conn = null;

    public function __construct($driver, $host, $login, $password, $database, $charset) {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection() {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(), 
                $this->config['login'], 
                $this->config['password']
            );
        }
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
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

    public function queryOne(string $sql, array $params = []) {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll(string $sql, array $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryObject($sql, $params = [], $className) {
        return $this->queryAllObject($sql, $params, $className)[0];
    }

    public function queryAllObject($sql, $params = [], $className) {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $smtp->fetchAll();
    }

    public function lastInsertId() {
        return $this->getConnection()->lastInsertId();
    }

    public function getError(){
        return $this->getConnection()->errorInfo();
    }
}