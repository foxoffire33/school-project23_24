<?php

namespace Framework\Validator;

use Framework\database\Entity;
use Framework\Validator\Interfaces\ValidatetorInterface;

class Validator
{

    public $valid = [], $messages = [];
    private Entity $entity;
    private array $validators;


    private function resolveValidators(Entity $entity)
    {
        $reflection = new \ReflectionClass($entity);
        foreach ($reflection->getProperties() as $property) {
            foreach ($property->getAttributes() as $attribute) {
                $validator = $attribute->newInstance();
                $validator->attribute = $property->name;
                $validator->entity = $entity;

                $this->validators[] = $validator;
            }
        }
    }

    public function validate($entity)
    {
        if (!empty($entity))
            $this->resolveValidators($entity);

        foreach ($this->validators as $validator) {
            if (!is_null($validator->attribute) && $validator->isValid()){
                $this->valid[$validator->attribute] = $validator->entity->{$validator->attribute};
            }
            $this->messages = array_merge($validator->messages, $this->messages);
        }
    }

    public function validated($entity): array
    {
        if (!empty($entity))
            $this->validate($entity);

        return $this->valid;
    }
}