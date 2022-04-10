<?php

namespace Framework\Router\interfaces;

interface RouteInterface
{
    public function validate(): void;
    public function resolve(): void;
}