<?php

namespace Framework\view\components\Table;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Row extends CompositeWithLeaves implements LeafInterface, HasLeaves
{
    public function __construct(public ?string $class = null)
    {}

    public function render(): string
    {
        if(is_null($this->class)){
            $rendered = "<tr>";
        }else{
            $rendered = "<tr class='{$this->class}'>";
        }

        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }

        $rendered .= '</tr>';

        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }
}