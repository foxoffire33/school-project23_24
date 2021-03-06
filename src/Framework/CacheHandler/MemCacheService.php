<?php

namespace Framework\CacheHandler;

//todo implemete memcache for DI Conatainers and Router
use Framework\CacheHandler\Exceptions\UnableToConnectToCacheServerException;
use Framework\core\Config;
use Framework\core\Factories\SingletonFactory;


class MemCacheService extends SingletonFactory
{
    private \Memcached $memCache;

    private function __construct()
    {
        try {
            $config = Config::getInstance();
            $this->memCache  = new \Memcached;
            $this->memCache->addServer($config->cache['host'],intval($config->cache['port']));
        } catch (\Exception $exception){
            throw new UnableToConnectToCacheServerException($exception->getMessage());
        }

    }


    public function getVersion(): array {
        return $this->memCache->getVersion();
    }

    public function setKey(string $key, $value){
        $this->memCache->set($key, $value);
    }

    public function FlushAll(): void{
        $this->memCache->flush();
    }

    public function getByKey(string $key){
        return $this->memCache->get($key);
    }
}