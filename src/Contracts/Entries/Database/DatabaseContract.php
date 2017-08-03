<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;

/**
 * Interface DatabaseContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Database
 */
interface DatabaseContract
{

    /**
     * getRepository
     *
     * Nome da fonte qual está contido os dados do active record a ser manipulado
     *
     * @return string
     */
    public function getRepository();

    /**
     * getKeys
     *
     * Relação de chaves utilizadas como identificador do registro na persistência
     *
     * @return PropertyContract[]
     */
    public function getKeys();

    /**
     * getDependencies
     *
     * Relação de dependencias atribuidas ao registro
     *
     * @return PropertyContract[]
     */
    public function getDependencies();

    /**
     * getActions
     *
     * Relação de acoes utilizadas no contexto das operações de persistencia do registro
     *
     * @return ActionContract
     */
    public function getActions();
}
