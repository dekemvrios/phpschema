<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;

/**
 * Interface DependenciesContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Database
 */
interface DependenciesContract
{

    /**
     * getHasOne
     *
     * Retorna a relação de dependencias do tipo hasOne
     *
     * @return PropertyContract[]|boolean
     */
    public function getHasOne();

    /**
     * getHasMany
     *
     * Retorna a relação de dependencias do tipo hasMany
     *
     * @return PropertyContract[]|boolean
     */
    public function getHasMany();
}