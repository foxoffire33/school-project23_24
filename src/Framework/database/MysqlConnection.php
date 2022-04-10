<?php

namespace Framework\database;

use Framework\core\Config;
use Framework\core\MultiSingletonFactory;
use Framework\core\SingletonFactory;

class MysqlConnection extends MultiSingletonFactory
{

    private function __construct(public Config $config)
    {
        try {
            $this->db = new \PDO("mysql:host={$this->config->database['host']};dbname={$this->config->database['name']}", $this->config->database['username'], $this->config->database['password']);
        } catch (\Exception $e) {
             throw new \Exception('Error creating a database connection ');
        }
    }
    //todo werken niet goed, alle waardes die in table komen zijn het zelfde
    public function call(string $name, array $args): bool
    {

        $propsToImplode = [];

        foreach ($args as $key=>$value)
            $propsToImplode[] = ':' . $key;


        $sqlQuery = 'call ' . htmlspecialchars($name) .'(' . implode(', ',$propsToImplode) .')';
        $statement = $this->db->prepare($sqlQuery);
        //todo uitzoeken waarom binding niet goed gaat
       // $statement->bindParam('procedure', $name);

        foreach ($args as $key=>$arg)
            $statement->bindParam($key, $arg, \PDO::PARAM_INPUT_OUTPUT);


        if ($statement->execute())
            return true;
        return false;
    }

    public function query(string $query)
    {
        return $this->db->prepare($query)->execute();
    }
}