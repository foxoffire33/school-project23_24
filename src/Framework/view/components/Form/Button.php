<?php

namespace Framework\view\components\Form;

use Framework\view\interfaces\LeafInterface;

class Button implements LeafInterface
{

    public function __construct(
        public ?string $class = null,
        protected string $id = 'submit',
        protected string $type = 'submit',
        protected string $text = 'Submit'
    )
    {
    }

    public function render(): string
    {
        if ($this->class)
            return "<button type='{$this->type}' id='{$this->id}' class='{$this->class}'>{$this->text}</input>";

        return "<button type='{$this->type}' id='{$this->id}'>{$this->text}</input>";
    }
}