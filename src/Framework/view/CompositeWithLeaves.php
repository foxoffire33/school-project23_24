<?php

namespace Framework\view;

use Framework\view\interfaces\HasLeaves;
use Framework\view\interfaces\RenderableInterface;

abstract class CompositeWithLeaves implements RenderableInterface, HasLeaves
{
    protected array $leaves = [];
}