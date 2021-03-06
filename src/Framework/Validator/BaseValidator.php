<?php

namespace Framework\Validator;

use Framework\DatabaseHandler\Entity;
use Framework\Validator\Interfaces\ValidatetorInterface;

abstract class BaseValidator implements ValidatetorInterface
{
    public $messages = [];
    public $valid = [];
    public Entity $entity;
    public string $attribute;
}