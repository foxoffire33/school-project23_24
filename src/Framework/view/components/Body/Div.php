<?php

namespace Framework\view\components\Body;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Div extends CompositeWithLeaves implements LeafInterface, HasLeaves
{

    public function __construct(public ?string $class = null)
    {
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }

    public function render(): string
    {
        if(is_null($this->class)){
            $rednder = "<div>";
        }else {
            $rednder = "<div class='{$this->class}'>";
        }
        foreach ($this->leaves as $leaf){
            $rednder .= $leaf->render();
        }
        $rednder .= '</div>';
        return $rednder;
    }
}