<?php

namespace Framework\DatabaseHandler;

use Framework\Core\Application;
use Framework\core\Config;
use Framework\DatabaseHandler\exceptions\RecordNotFound;
use Framework\DatabaseHandler\exceptions\RecordNotFoundException;
use PDO;

abstract class Entity
{

    public function __construct()
    {
        $this->mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
    }

    public function update(array $attributes)
    {
        $class = new \ReflectionClass(get_called_class());

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (isset($attributes[$property->getName()]) && !empty($attributes[$property->getName()])) {
                $property->setValue($this, $attributes[$property->getName()]);
            }
        }
        return $this;
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

    public function delete(){
        $class = new \ReflectionClass($this);
        $className = strtolower($class->getShortName());

        $sqlQuery = "delete from {$className} where id = :id";
        $statement = $this->mysqlConnection->db->prepare($sqlQuery);
        $statement->bindParam("id",$this->id);
        return $statement->execute();
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
        $statement = self::prepareStatement($options);
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



        if ($statement->execute() ){
            $result = $statement->fetch();
            if($result)
                return $result;

            throw new RecordNotFoundException;
        }




    }

    private static function prepareStatement($options): \PDOStatement{
        $class = new \ReflectionClass(get_called_class());
        $tableName = strtolower($class->getShortName());
        $mysqlConnection = Application::getContainer()->get(MysqlConnection::class);
        $propsToImplode = [];


        foreach ($options as $key=>$value) {
            if($value){
                $propsToImplode[$key] = '`' . $key . '` = :' . $key . ' ';
            }else{
                $propsToImplode[$key] = ' `' . $key . '` '. ' IS NULL ';
            }
        }

        $inploded = implode('and', $propsToImplode);

        if(empty($inploded)) {
            $statement = $mysqlConnection->db->prepare("select * from {$tableName}");
        }else{
            $statement = $mysqlConnection->db->prepare("select * from {$tableName} where {$inploded}");
            foreach ($options as $key=>$value) {
                if($value)
                    $statement->bindParam($key,$value);
            }
        }

        $statement->setFetchMode(PDO::FETCH_CLASS, $class->getName());
        return $statement;
    }

    public static function findAll($options = [])
    {
        $statement = self::prepareStatement($options);
        if ($statement->execute())
            return $statement->fetchAll();
    }
}