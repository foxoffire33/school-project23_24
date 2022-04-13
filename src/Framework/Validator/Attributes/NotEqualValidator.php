<?php

namespace Framework\Validator\Attributes;

use Framework\Validator\BaseValidator;
use Framework\Validator\Interfaces\ValidatetorInterface;

#[\Attribute]
class NotEqualValidator extends BaseValidator implements ValidatetorInterface
{

    public function __construct(private string $compareAttribute)
    {
    }

    function isValid(): bool
    {
        return !($this->entity->{$this->compareAttribute} === $this->entity->{$this->attribute});
    }

    function hasMessages(): bool
    {
        return !empty($this->hasMessages());
    }

    public function validate(): void
    {
         if ($this->isValid() && !is_null($this->entity?->{$this->attribute})){
             $this->valid[] = $this;
         }else {
             $this->messages[] = "$this->attribute is should not be Equal to $this->compareAttribute";
         }
    }

    function validated(): array
    {
        return array_map(fn() => [$this->attribute => $this->entity->{$this->attribute}],$this->valid);
    }
}