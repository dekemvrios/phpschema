<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;

/**
 * Interface GenericContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface GenericContract
{

    /**
     * isRequired
     *
     * Retorna valor lógico indicando a obrigatóriedade de utilização do registro
     *
     * @return boolean
     */
    public function isRequired();
}