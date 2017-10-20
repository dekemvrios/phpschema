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
     * @return string
     */
    public function getAlias();

    /**
     * @return string
     */
    public function getProperty();

    /**
     * @return string
     */
    public function getField();

    /**
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


    /**
     * getDescription
     *
     * Retorna a descrição do campo atribuido ao schema
     *
     * @return string
     */
    public function getDescription();

    /**
     * Retorna o valor default a ser atribuido a propriedade especificada no schema
     *
     * @return mixed
     */
    public function getDefault();

    /**
     * getAllowedValues
     *
     * Retorna a relação de valores válidos a serem atribuidos ao respectivo campo
     *
     * @return array
     */
    public function getAllowedValues();

    /**
     * @return bool
     */
    public function hasSharedFields();

    /**
     * @return array|string
     */
    public function getSharedFields();

    /**
     * @return string
     */
    public function getCompositionClass();

    /**
     * @return string
     */
    public function getCompositionField();

    /**
     * @return string
     */
    public function getCompositionRefers();

    /**
     * @return string
     */
    public function getCompositionType();

    /**
     * @return bool
     */
    public function hasReplicateBehavior();

    /**
     * @return string
     */
    public function getWhenReplicateAction();

    /**
     * @return mixed
     */
    public function getWhenReplicateStaticValue();

    /**
     * @return string
     */
    public function getWhenPatchAction();

    /**
     * @return bool
     */
    public function isRequired();
}
