<?php

namespace Framework\view\components\Table;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class TFooter extends CompositeWithLeaves implements LeafInterface, HasLeaves
{
    public function __construct(public ?string $class = null)
    {}

    public function render(): string
    {
        $rendered = "<tfoot class='{$this->class}'>";
        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }

        $rendered .= '</tfoot>';

        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }
}