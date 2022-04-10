<?php

namespace Framework\view\components\Table;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Th extends CompositeWithLeaves implements LeafInterface, HasLeaves
{
    public function __construct(
        public ?string $class = null,
        public? string $text = null)
    {}

    public function render(): string
    {
        $rendered = "<th class='{$this->class}'>";
        if(!empty($this->text))
            $rendered .= trim($this->text);

        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }

        $rendered .= '</th>';

        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }
}