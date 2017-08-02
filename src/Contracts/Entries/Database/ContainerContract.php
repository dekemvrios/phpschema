<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

/**
 * Interface PropertyContainerContract
 *
 * @package Solis\Expressive\Schema\Contracts
 */
interface ContainerContract
{

    /**
     * getProperties
     *
     * Retorna as especificações do database do active record
     *
     * @return DatabaseContract
     */
    public function getDatabase();
}
