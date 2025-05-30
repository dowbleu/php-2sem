<?php

namespace src\Models;

use src\Services\Db;

abstract class ActiveRecordEntity //абстрактный класс для работы с базой данных
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function __set($column, $value) 
    {
        $property = $this->upperToCamelCase($column);
        $this->$property = $value;
    }

    protected abstract static function getTableName();

    private function upperToCamelCase($column)
    {
        return lcfirst(str_replace('_', '', ucwords($column, '_')));
    }

    private function camelcaseToUpper($property)
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $property));
    }

    protected function MappedPropertiesToDB() //преобразует свойства в массив для базы данных
    {
        $reflector = new \ReflectionObject($this); 
        $properties = [];
        foreach ($reflector->getProperties() as $property) {
            $propertyName = $property->getName();
            $propertyNameDb = $this->camelcaseToUpper($propertyName);
            $properties[$propertyNameDb] = $this->$propertyName;
        }
        return $properties;
    }

    public static function findAll(): array //получает все объекты
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '`';
        return $db->query($sql, [], static::class);
    }

    public static function getById(int $id) //получает объект по id
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `id`=:id';
        $entities = $db->query($sql, [':id' => $id], static::class); 
        return $entities ? $entities[0] : null;
    }

    public function save() //сохраняет объект в базу данных
    {
        $propertisDB = $this->MappedPropertiesToDB();
        if ($this->id) $this->update($propertisDB);
        else $this->insert($propertisDB);
    }

    protected function update($propertisDB) //обновляет объект в базе данных
    {
        $db = DB::getInstance();
        $columns2Params = []; //массив для хранения параметров
        $params2Values = []; //массив для хранения значений параметров
        foreach ($propertisDB as $key => $value) {
            $param = ':' . $key;
            $column = '`' . $key . '`';
            $columns2Params[] = $column . '=' . $param;
            $params2Values[$param] = $value;
        }
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(',', $columns2Params) . ' WHERE `id`=:id';
        $db->query($sql, $params2Values, static::class);
    }

    protected function insert($propertisDB) //вставляет объект в базу данных
    {
        $propertisDB = array_filter($propertisDB);
        $db = Db::getInstance();
        $columns = [];
        $params = [];
        $params2Values = [];
        foreach ($propertisDB as $key => $value) {
            $columns[] = '`' . $key . '`';
            $param = ':' . $key;
            $params[] = $param;
            $params2Values[$param] = $value;
        }
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(',', $columns) . ') VALUES (' . implode(',', $params) . ')';
        $db->query($sql, $params2Values, static::class);
        $this->id = $db->getConnection()->lastInsertId();
    }

    public function delete() //удаляет объект из базы данных
    {
        $db = Db::getInstance();
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE `id`=:id';
        $db->query($sql, [':id' => $this->id], static::class);
    }
}