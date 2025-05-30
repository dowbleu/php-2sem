<?php

namespace src\Services;

use src;

class Db
{
    private $connect;
    private static $instance;

    private function __construct()
    {
        try {
            $dbOptions = require('settings.php');
            $this->connect = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';port=' . $dbOptions['port'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );

            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //выводит ошибки
            $this->connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC); //возвращает ассоциативный массив
        } catch (\PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(): Db //проверяет, существует ли подключение к базе данных, и если нет, то создает его
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array //выполняет запрос к базе данных
    {
        $sth = $this->connect->prepare($sql); //подготавливает запрос
        $result = $sth->execute($params); //выполняет запрос
        if (!$result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className); //возвращает все строки в виде объектов
    }

    public function getConnection(): \PDO 
    {
        return $this->connect;
    }
}
