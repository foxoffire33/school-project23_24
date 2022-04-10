<?php

namespace Framework\view\components\Form;

use Framework\view\interfaces\LeafInterface;

class InputLabel implements LeafInterface
{

    public function __construct(
        protected string $id,
        protected string $text = '',
        public string $class = 'block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
    )
    {
    }

    public function render(): string
    {
        return "<label type='text' for='{$this->id}' class='{$this->class}'>{$this->text}</label>";
    }
}