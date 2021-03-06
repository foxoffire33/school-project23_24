<?php

namespace Framework\Validator\Attributes;

use Framework\DatabaseHandler\Entity;
use Framework\Validator\BaseValidator;
use Framework\Validator\Interfaces\ValidatetorInterface;

#[\Attribute]
class StringValidator extends BaseValidator implements ValidatetorInterface
{

    function isValid(): bool
    {
        return  is_string($this->entity->{$this->attribute});
    }

    function hasMessages(): bool
    {
        return !empty($this->hasMessages());
    }

    function validate(): void
    {
         if ($this->isValid())
             $this->valid[] = $this;
    }

    function validated(): array
    {
        return array_map(fn() => [$this->attribute => $this->entity->{$this->attribute}],$this->valid);
    }
}