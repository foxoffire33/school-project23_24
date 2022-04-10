<?php

namespace Framework\Validator\Attributes;

use Framework\Validator\BaseValidator;
use Framework\Validator\Interfaces\ValidatetorInterface;

#[\Attribute]
class FloatValidator extends BaseValidator implements ValidatetorInterface
{

    public function __construct()
    {
    }

    function isValid(): bool
    {
        return  is_float($this->entity->{$this->attribute});
    }

    function hasMessages(): bool
    {
        return !empty($this->hasMessages());
    }

    function validate(): void
    {
         if ($this->isValid() && !is_null($this->entity?->{$this->attribute}))
             $this->valid[] = $this;
    }

    function validated(): array
    {
        return array_map(fn() => [$this->attribute => $this->model->{$this->attribute}],$this->valid);
    }
}