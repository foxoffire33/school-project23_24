<?php

namespace Framework\view\components\Table;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class THead extends CompositeWithLeaves implements LeafInterface, HasLeaves
{
    public function __construct(public ?string $class = null)
    {}

    public function render(): string
    {
        $rendered = "<thead class='{$this->class}'>";
        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }

        $rendered .= '</thead>';

        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }
}