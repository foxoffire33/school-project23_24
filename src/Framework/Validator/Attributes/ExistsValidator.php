<?php

namespace Framework\Validator\Attributes;

use Framework\Validator\BaseValidator;
use Framework\Validator\Interfaces\ValidatetorInterface;

#[\Attribute]
class ExistsValidator extends BaseValidator implements ValidatetorInterface
{

    public function __construct(private string $foreignEntity)
    {
    }

    function isValid(): bool
    {
        $foreignEntity = ($this->foreignEntity)::findById($this->attribute);
        return !empty($foreignEntity);
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
        return array_map(fn() => [$this->attribute => $this->model->{$this->attribute}],$this->valid);
    }
}