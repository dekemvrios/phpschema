<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

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
     * @return string|array
     */
    public function getKeys();
}