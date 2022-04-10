<?php

namespace Framework\view\interfaces;

interface HasLeaves
{
    public function addLeave(LeafInterface $leave): void;
}