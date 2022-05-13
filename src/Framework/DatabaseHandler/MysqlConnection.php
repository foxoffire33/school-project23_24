<?php

namespace Framework\DatabaseHandler;

use Framework\core\Config;
use Framework\core\Factories\MultiSingletonFactory;

class MysqlConnection extends MultiSingletonFactory
{

    public $db = null;
    private $config;

    private function __construct()
    {
        $this->restoreOnWakeUp();
    }


    private function restoreOnWakeUp()
    {
        $this->config = Config::getInstance();

        try {
            $this->db = new \PDO("mysql:host={$this->config->database['host']};dbname={$this->config->database['name']}", $this->config->database['username'], $this->config->database['password']);
        } catch (\Exception) {
            throw new \Exception('Error creating a database connection ');
        }
    }

    //todo werken niet goed, alle waardes die in table komen zijn het zelfde
    public function call(string $name, array $args): bool
    {

        $propsToImplode = [];

        foreach ($args as $key => $value)
            $propsToImplode[] = ':' . $key;


        $sqlQuery = 'call ' . htmlspecialchars($name) . '(' . implode(', ', $propsToImplode) . ')';
        $statement = $this->db->prepare($sqlQuery);
        //todo uitzoeken waarom binding niet goed gaat
        // $statement->bindParam('procedure', $name);

        foreach ($args as $key => $arg)
            $statement->bindParam($key, $arg, \PDO::PARAM_INPUT_OUTPUT);


        if ($statement->execute())
            return true;
        return false;
    }

    public function query(string $query)
    {
        try {
            return $this->db->prepare($query)->execute();
        } catch (\PDOException $exception) {
            if ($exception->getCode() < 42000)
                throw new \Exception($exception->getMessage(), $exception->getCode(), $exception->getPrevious());

            $_SESSION['flash']['error'][] = $exception->getMessage();
        }
    }

    public function __wakeup(): void
    {
        $this->restoreOnWakeUp();
    }

    public function __sleep()
    {
        return [];
    }
}