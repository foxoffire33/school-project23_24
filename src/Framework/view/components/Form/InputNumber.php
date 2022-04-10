<?php

namespace Framework\view\components\Form;

use Framework\view\interfaces\LeafInterface;

class InputNumber implements LeafInterface
{

    public function __construct(
        protected string $id,
        protected string $name,
        protected float $step = 0.1,
        protected ?string $value = null,
        protected string $placeholder = '',
        protected string $class = 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'
    )
    {
    }

    public function render(): string
    {
        return "<input type='number' id='{$this->id}' name='{$this->name}' step='{$this->step}' value='{$this->value}' placeholder='{$this->placeholder}' class='{$this->class}'/>";
    }
}