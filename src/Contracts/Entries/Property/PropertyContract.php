<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Property;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;
use Solis\Expressive\Schema\Contracts\Entries\Composition\CompositionContract;
use Solis\Expressive\Schema\Contracts\Entries\DynamicFunction\DynamicFunctionContract;

/**
 * Interface PropertyContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Property
 */
interface PropertyContract
{

    /**
     * getAlias
     *
     * Identificador de índice de array de dados fornecido como argumento para método attach para instanciar model
     *
     * @return string
     */
    public function getAlias();

    /**
     * getProperty
     *
     * Nome da propriedade presente na classe a ser instanciada
     *
     * @return string
     */
    public function getProperty();

    /**
     * getField
     *
     * Nome do campo na persistência qual reflete a propriedade na respectiva classe
     *
     * @return string
     */
    public function getField();

    /**
     * getType
     *
     * Tipo de dado da propriedade
     *
     * @return string
     */
    public function getType();

    /**
     * getFormat
     *
     * Relação de estruturas de formatação utilizadas para tratar o dado da propriedade antes de ser atribuída
     *
     * @return DynamicFunctionContract[]
     */
    public function getFormat();

    /**
     * getComposition
     *
     * Retorna as definições de relacionamento quando a propriedade for do tipo composição
     *
     * @return CompositionContract
     */
    public function getComposition();

    /**
     * getBehavior
     *
     * Retorna as especificações do comportamento da propriedade do registro
     *
     * @return GenericContract
     */
    public function getBehavior();
}
