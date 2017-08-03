<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\DependenciesContract;

/**
 * Class Dependencies
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Database
 */
class Dependencies implements DependenciesContract
{

    /**
     * @var PropertyContract[]
     */
    private $hasOne = [];

    /**
     * @var PropertyContract[]
     */
    private $hasMany = [];

    /**
     * getHasOne
     *
     * Retorna a relação de dependencias do tipo hasOne
     *
     * @return PropertyContract[]|boolean
     */
    public function getHasOne()
    {
        return !empty($this->hasOne) ? $this->hasOne : false;
    }

    /**
     * @param PropertyContract[] $hasOne
     */
    public function setHasOne($hasOne)
    {
        $this->hasOne = $hasOne;
    }

    /**
     * getHasMany
     *
     * Retorna a relação de dependencias do tipo hasMany
     *
     * @return PropertyContract[]|boolean
     */
    public function getHasMany()
    {
        return !empty($this->hasMany) ? $this->hasMany : false;
    }

    /**
     * @param PropertyContract[] $hasMany
     */
    public function setHasMany($hasMany)
    {
        $this->hasMany = $hasMany;
    }

    /**
     * toArray
     *
     * Retorna representação em array do registro
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];

        if (!empty($this->getHasOne())) {
            $array['hasOne'] = [];
            foreach ($this->getHasOne() as $item) {
                $array['hasOne'][] = $item->toArray();
            }
        }

        if (!empty($this->getHasMany())) {
            $array['hasMany'] = [];
            foreach ($this->getHasMany() as $item) {
                $array['hasMany'][] = $item->toArray();
            }
        }

        return $array;
    }
}