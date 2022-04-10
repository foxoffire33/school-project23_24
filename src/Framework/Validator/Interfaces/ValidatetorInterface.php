<?php

namespace Framework\Validator\Interfaces;

interface ValidatetorInterface
{
    /**
     * Checking if attribute validation has succeeded
     * @return bool
     */
    function isValid(): bool;

    /**
     * Checks if the messages array is empty
     * @return bool
     */
    function hasMessages(): bool;

    /**
     * Validate current attributes
     * @return void
     */
    function validate(): void;

    /**
     * Returns a array of all valid attributes
     * @return array
     */
    function validated(): array;
}