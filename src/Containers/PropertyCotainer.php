<?php

namespace Solis\Expressive\Schema\Containers;

use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Entries\Property;
use Solis\Breaker\TException;

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
     * make
     *
     * @param array $schema
     *
     * @return static
     * @throws TException
     */
    public static function make($schema)
    {
        if (!array_key_exists(
            'properties',
            $schema
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'properties' field has not been found for defining schema entry",
                500
            );
        }
        $propertiesEntry = $schema['properties'];

        $instance = new self();
        foreach ($propertiesEntry as $item) {
            $instance->append(
                Property::make($item)
            );
        }

        return $instance;
    }

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

    /**
     * append
     *
     * Adiciona uma nova entrada a relação de propriedades
     *
     * @param PropertyContract $property
     */
    public function append($property)
    {
        array_push(
            $this->properties,
            $property
        );
    }
}