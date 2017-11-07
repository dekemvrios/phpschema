<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Composition;

/**
 * Interface RelationshipContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Composition
 */
interface RelationshipContract
{

    /**
     * getType
     *
     * Retorna o tipo de relacionamento qual existe entre o active record e composição
     *
     * @return string
     */
    public function getType();

    /**
     * getSource
     *
     * Retorna os campos que fazem parte do relacionamento entre active record e composição
     *
     * @return SourceContract
     */
    public function getSource();

    /**
     * getSharedFields
     *
     * Retorna relação de campos compartilhados entre active record composição
     *
     * @return string|array
     */
    public function getSharedFields();

    /**
     * getCommonFields
     *
     * Retorna relação de campos compartilhados entre active record composição
     *
     * @return array|string
     */
    public function getCommonFields();
}
