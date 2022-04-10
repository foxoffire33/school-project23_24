<?php

namespace Framework\view\components\Form;

use Framework\view\CompositeWithLeaves;
use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\LeafInterface;

class Select extends CompositeWithLeaves implements LeafInterface, HasLeaves
{

    private int $selected;

    public function __construct(
        public array $options,
        public string $id,
        public ?string $class = 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 pl-3',
    )
    {

        if(empty($this->selected))
            $this->selected ??= ($_POST[$id] ?? 0);

        if(empty($this->options))
            return true;

        foreach ($this->options as $id=>$option){
            $this->addLeave(new Option($option['value'],$option['text'],($id==$this->selected)));
        }
    }

    public function render(): string
    {

         $rendered = '';

        if ($this->class)
            $rendered .= "<select name='{$this->id}' id='{$this->id}' class='{$this->class}'>";


        if (!$this->class)
            $rendered .= "<select name='{$this->id}' id='{$this->id}'>";

        foreach ($this->leaves as $item) {
            $rendered .= $item->render();
        }

        $rendered .= "</select>";
        return $rendered;
    }

    public function addLeave(LeafInterface $leave): void
    {
        $this->leaves[] = $leave;
    }
}