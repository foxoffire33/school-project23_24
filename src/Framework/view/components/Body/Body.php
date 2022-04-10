<?php

namespace Framework\view\components\Body;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Body extends CompositeWithLeaves implements LeafInterface, HasLeaves
{

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }

    public function render(): string
    {
        $rendered = '<body>';
        foreach ($this->leaves as $leaf) {
            $rendered .= $leaf->render();
        }
        $rendered .= '</body>';
        return $rendered;
    }
}