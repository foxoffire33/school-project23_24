<?php

namespace Framework\view\components\Form;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\LeafInterface;

class Form extends CompositeWithLeaves implements LeafInterface
{

    public function __construct(
        public string $action = '/',
        public string $method = 'POST',
        public string $class = 'w-full max-w-lg'
    )
    {
        $this->addLeave(new InputField('csrf_token','csrf_token','hidden',$_SESSION['csrf_token'],'',''));
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }

    public function render(): string
    {
        $rendered = "<form action='{$this->action}' method='{$this->method}' class='{$this->class}'>";
        foreach ($this->leaves as $leaf){
            $rendered .= $leaf->render();
        }
        $rendered .= "</form>";

        return $rendered;
    }
}