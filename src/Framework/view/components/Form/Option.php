<?php

namespace Framework\view\components\Form;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Option implements LeafInterface
{

    public function __construct(private int $value, protected string $text,protected bool $selected)
    {}

    public function render(): string
    {
        if ($this->selected)
            return "<option value='{$this->value}' selected>{$this->text}</option>";
        return "<option value='{$this->value}'>{$this->text}</option>";
    }
}