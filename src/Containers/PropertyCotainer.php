<?php

namespace Solis\Expressive\Schema\Containers;

use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;

/**
 * Class PropertyCotainer
 *
 * @package Solis\Expressive\Schema\Containers
 */
class PropertyCotainer implements PropertyContainerContract
{
    /**
     * @var PropertyContract[]
     */
    private $properties;

    /**
     * setProperties
     *
     * Atribui a relação de propriedades do active record
     *
     * @param PropertyContract[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * getProperties
     *
     * Retorna a relação de propriedades do active record
     *
     * @return PropertyContract[]
     */
    public function getProperties()
    {
        return $this->properties;
    }
}