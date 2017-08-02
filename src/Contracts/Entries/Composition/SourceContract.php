<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Composition;

/**
 * Interface SourceContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Composition
 */
interface SourceContract
{

    /**
     * getField
     *
     * Retorna o nome da propriedade no active record que contém o valor do campo relacionamento
     *
     * @return string
     */
    public function getField();

    /**
     * getRefers
     *
     * Retorna o nome da propriedade na composião que contém o valor do campo relacionamento
     *
     * @return string
     */
    public function getRefers();
}