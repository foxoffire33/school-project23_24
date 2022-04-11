<?php

namespace Framework\view\exceptions;

class ViewFileNotFoundException extends \Exception
{
    protected $code = 500;
    protected $message = "View File not found";
}