<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;

/**
 * Interface BehaviorContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface BehaviorContract
{
    /**
     * getTypeBehavior
     *
     * Retorna as especificações de comportamento de acordo com o tipo de dado
     *
     * @return IntegerContract|null
     */
    public function getTypeBehavior();
}