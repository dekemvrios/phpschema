<?php

namespace Solis\Expressive\Schema\Operations;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;

/**
 * Trait DatabaseOperations
 *
 * @package Solis\Expressive\Operations
 */
trait DatabaseOperations
{
    use DatabaseFieldsOperations;


    /**
     * getRepository
     *
     * Retorna o nome do repositorio utilizado para persistir o registro
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->getDatabaseContainer()->getDatabase()->getRepository();
    }

    /**
     * getKeys
     *
     * Retorna a relação de propriedades especificadas como chaves de identificação do active record
     *
     * @return PropertyContract[]
     */
    public function getKeys()
    {
        return $this->getDatabaseContainer()->getDatabase()->getKeys();
    }

    /**
     * getActions
     *
     * Retorna a relação de ações especificadas a serem executadas no contexto da persistência
     *
     * @return ActionContract
     */
    public function getActions()
    {
        return $this->getDatabaseContainer()->getDatabase()->getActions();
    }

    /**
     * getDependencies
     *
     * Retorna a relação de propriedades especificadas como dependências do active record
     *
     * @param  string $type tipo de dependencia a ser retornada
     *
     * @return PropertyContract[]|boolean
     */
    public function getDependencies($type = null)
    {
        if (empty($this->getDatabaseContainer()->getDatabase()->getDependencies())) {
            return false;
        }

        if (!empty($type)) {
            return $this->getDatabaseContainer()->getDatabase()->getDependencies()->{'get' . $type}();
        }

        $array = [];

        $hasOne = $this->getDatabaseContainer()->getDatabase()->getDependencies()->getHasOne();
        if (!empty($hasOne)) {
            $array = array_merge(
                $array,
                array_values($hasOne)
            );
        }

        $hasMany = $this->getDatabaseContainer()->getDatabase()->getDependencies()->getHasMany();
        if (!empty($hasMany)) {
            $array = array_merge(
                $array,
                array_values($hasMany)
            );
        }

        return !empty($array) ? $array : false;
    }
}