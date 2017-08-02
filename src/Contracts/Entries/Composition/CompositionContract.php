<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Composition;

/**
 * Class CompositionContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Composition
 */
interface CompositionContract
{

    /**
     * getClass
     *
     * Nome da classe a ser instânciada representando a composição
     *
     * @return string
     */
    public function getClass();

    /**
     * getRelationship
     *
     * Especificações sobre o relacionamento entre o registro e a sua respectiva composição
     *
     * @return RelationshipContract
     */
    public function getRelationship();
}