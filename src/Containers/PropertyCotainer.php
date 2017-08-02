<?php

namespace Solis\Expressive\Schema\Containers;

use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Entries\Property;
use Solis\Expressive\Schema\SchemaException;

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
    private $properties = [];

    /**
     * make
     *
     * @param array $properties
     *
     * @return static
     * @throws SchemaException
     */
    public static function make($properties)
    {
        $instance = new self();
        foreach ($properties as $item) {
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

    /**
     * getMeta
     *
     * Retorna um array de objetos contendo a relação de propriedades de acordo com o identificador fornecido
     * como argumento
     *
     * @param array|string $properties valor de propriedade a ser buscada na relação schema
     * @param string       $identifier valor de campo a ter o valor comparado ao valor desejado
     *
     * @return array|bool
     */
    public function getMeta(
        $properties,
        $identifier = 'property'
    ) {
        $properties = !is_array($properties) ? [$properties] : $properties;

        $meta = array_filter($this->getProperties(), function (PropertyContract $property) use ($properties, $identifier) {
            return in_array($property->{'get' . $identifier}(), $properties);
        });

        return !empty($meta) ? $meta : false;
    }

    /**
     * getValue
     *
     * Retorna um array dos valores atribuidos aos propriedades do schema de acordo com o identificador fornecido
     * como argumento
     *
     * @param string $identifier
     *
     * @return array|bool
     */
    public function getValue(
        $identifier
    ) {
        $meta = array_map(function (PropertyContract $property) use ($identifier){
            return $property->{'get' . $identifier}();
        }, $this->getProperties());

        return !empty($meta) ? $meta : false;
    }
}
