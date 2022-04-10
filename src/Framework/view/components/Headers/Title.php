<?php

namespace Framework\view\components\Headers;

use Framework\view\interfaces\LeafInterface;

class Title implements LeafInterface
{

    public function __construct(public string $title = 'My webpage')
    {
    }

    public function render(): string
    {
        return "<title>{$this->title}</title>";
    }
}