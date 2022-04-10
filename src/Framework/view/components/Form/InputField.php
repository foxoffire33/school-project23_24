<?php

namespace Framework\view\components\Form;

use Framework\view\interfaces\LeafInterface;

class InputField implements LeafInterface
{

    public function __construct(
        protected string $id,
        protected string $name,
        protected string $type,
        protected string $value,
        protected string $placeholder = '',
        protected string $class = 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'
    )
    {
    }

    public function render(): string
    {
        return "<input type='{$this->type}' id='{$this->id}' name='{$this->name}' value='{$this->value}' placeholder='{$this->placeholder}' class='{$this->class}'/>";
    }
}