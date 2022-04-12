<?php

namespace Framework\Validator\Attributes;

use Framework\Validator\BaseValidator;
use Framework\Validator\Interfaces\ValidatetorInterface;

#[\Attribute]
class IntegerValidator extends BaseValidator implements ValidatetorInterface
{

    function isValid(): bool
    {
        return  is_integer($this->entity->{$this->attribute});
    }

    function hasMessages(): bool
    {
        return !empty($this->hasMessages());
    }

    function validate(): void
    {
         if ($this->isValid() && !is_null($this->entity->{$this->attribute}))
             $this->valid[] = $this;
    }

    function validated(): array
    {
        return array_map(fn() => [$this->attribute => $this->entity->{$this->attribute}],$this->valid);
    }
}