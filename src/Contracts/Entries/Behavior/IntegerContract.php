<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;

/**
 * Interface IntContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface IntegerContract
{

    /**
     * isAutoIncrement
     *
     * Retorna valor lógico indicando se o campo é auto incremental ou não
     *
     * @return boolean
     */
    public function isAutoIncrement();

    /**
     * getIncrementalBehavior
     *
     * Retorna o comportamento incremental do respectivo campo
     *
     * @return string
     */
    public function getIncrementalBehavior();
}