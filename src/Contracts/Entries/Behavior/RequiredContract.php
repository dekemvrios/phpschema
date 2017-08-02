<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;

/**
 * Interface RequiredContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface RequiredContract
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