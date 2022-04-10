<?php

namespace Framework\Middleware\Attributes;

use Framework\Middleware\AbstractHandler;
use Framework\Middleware\Interfaces\Handler;
use http\Exception;

#[\Attribute]
class ThrottleMiddleware extends AbstractHandler implements Handler
{

    public function __construct(
        public $requests = 10,
        public $seconds = 60
    )
    {
    }

    public function handle(): ?string
    {
            $fp = fopen(sys_get_temp_dir()."/".session_id().'.throttle', "w+");
            if (flock($fp, LOCK_EX)) {
                sleep(($this->seconds / $this->requests));
                flock($fp, LOCK_UN); // unlock
            }else{
                throw new \HttpException();
            }
            fclose($fp);

        return parent::handle();
    }
}