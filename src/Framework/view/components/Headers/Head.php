<?php

namespace Framework\view\components\Headers;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Head extends CompositeWithLeaves implements LeafInterface, HasLeaves
{
    public function __construct()
    {
    }

    public function render(): string
    {
        $rendered = '<head>';
        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }

        $rendered .= '</head>';

        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        // TODO: Implement addLeave() method.
    }
}