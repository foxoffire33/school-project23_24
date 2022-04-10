<?php

namespace Framework\Router\interfaces;

interface RouterAttributeInterface
{
    public function validate(): bool;
    public function resolve(): void;
}