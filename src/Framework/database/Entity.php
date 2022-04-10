<?php

namespace Framework\database;

use Framework\Core\Application;
use Framework\core\Config;
use PDO;

abstract class Entity
{

    public function __construct()
    {
        $this->mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
    }

    public static function create(array $array)
    {
        $class = new \ReflectionClass(get_called_class());
        $entity = $class->newInstance();

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (isset($array[$property->getName()])) {
                $property->setValue($entity, $array[$property->getName()]);
            }
        }
        return $entity;
    }

    public function save()
    {

        $class = new \ReflectionClass($this);
        $tableName = strtolower($class->getShortName());

        $propsToImplode = [];

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $propertyName = $property->getName();
            if ($propertyName == 'id' && is_null($this->id) || $this->{$propertyName} === null)
                continue;
            $propsToImplode[$propertyName] = '`' . $propertyName . '` = :' . $propertyName . '';
        }

        $setClause = implode(',', $propsToImplode);

        if (!is_null($this->id)) {
            $sqlQuery = 'UPDATE `' . $tableName . '` SET ' . $setClause . ' WHERE id = ' . $this->id;
        } else {
            $sqlQuery = 'INSERT INTO `' . $tableName . '` SET ' . $setClause;
        }

        $mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
        $statement = $mysqlConnection->db->prepare($sqlQuery);

        foreach ($propsToImplode as $key=>$value){
            $statement->bindParam($key, $this->{$key});
        }
        if ($mysqlConnection->db->errorCode() > 0) {
            throw new \Exception($mysqlConnection->db->errorInfo()[2]);
        }

        return $statement->execute();
    }

    public static function findOne($options = [])
    {
        $class = new \ReflectionClass(get_called_class());
        $tableName = strtolower($class->getShortName());
        $mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
        $propsToImplode = [];



        foreach ($options as $key=>$value) {
            $propsToImplode[$key] = '`' . $key . '` = :' . $key . '';
        }

        $inploded = implode(',', $propsToImplode);



        $statement = $mysqlConnection->db->prepare("select * from {$tableName} where " . $inploded);
        $statement->setFetchMode(PDO::FETCH_CLASS, $class->getName());

        foreach ($options as $key=>$value) {
            $statement->bindParam($key,$value);
        }

        if ($statement->execute())
            return $statement->fetch();
    }

    public static function findById($id)
    {
        $class = new \ReflectionClass(get_called_class());
        $tableName = strtolower($class->getShortName());
        $mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
        $statement = $mysqlConnection->db->prepare("select * from {$tableName} where id = :id");
        $statement->bindParam('id', $id);
        $statement->setFetchMode(PDO::FETCH_CLASS, $class->getName());

        if ($statement->execute())
            return $statement->fetch();
    }

    public static function findAll()
    {
        $class = new \ReflectionClass(get_called_class());
        $tableName = strtolower($class->getShortName());
        $mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
        $statement = $mysqlConnection->db->prepare("select * from {$tableName}");
        $statement->setFetchMode(PDO::FETCH_CLASS, $class->getName());
        if ($statement->execute())
            return $statement->fetchAll();

        if ($mysqlConnection->mysqlConnection->db->errorCode())
            throw new \Exception($mysqlConnection->mysqlConnection->db->errorInfo()[2]);
    }

    public function find($options = [])
    {

        $result = [];
        $query = '';

        if (is_array($options)) {

        } elseif (is_stirng($options)) {
            $query = 'WHERE ' . $options;
        } else {
            throw new \Exception('Wrong parameter type of options');
        }

        $raw = $this->mysqlConnection->execute($query);
        foreach ($raw as $rawRow) {
            $result[] = self::map($rawRow);
        }

        return $result;
    }
}