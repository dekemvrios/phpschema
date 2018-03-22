<?php

namespace Solis\Expressive\Schema\Operations;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;

/**
 * Trait PropertiesOperations
 *
 * @package Solis\Expressive\Operations
 */
trait PropertiesOperations
{

    /**
     * @var PropertyContract[]
     */
    private $propertiesWithDefaultValue = [];

    /**
     * @var PropertyContract[]
     */
    private $propertiesWithNotNullConstraint = [];

    /**
     * getProperties
     *
     * Retorna a relação de propriedades do active record
     *
     * @return PropertyContract[]
     */
    public function getProperties()
    {
        return $this->getPropertyContainer()->getProperties();
    }

    /**
     * getPropertyEntryByIdentifier
     *
     * Retornar o conjunto de especificações de determinada propriedade presente no schema de acordo com a relação de
     * valor a ser encontrado e a qual entrada do conjunto de propriedades pertence esse valor.
     *
     * @param mixed  $value      Valor a ser comparado com determinada entrada no conjunto de propriedades
     * @param string $identifier Propriede qual contem o valor a ser buscado
     *
     * @return PropertyContract|boolean
     */
    public function getPropertyEntryByIdentifier(
        $value,
        $identifier = 'property'
    ) {
        foreach ($this->getPropertyContainer()->getProperties() as $property) {
            if ($property->{'get' . $identifier}() == $value) {
                return $property;
            }
        }

        return false;
    }

    /**
     *
     * Retorna a relacao de meta informações de todas as propriedades que possuem valor default
     *
     * @return PropertyContract[]
     */
    public function getPropertiesWithDefaultValue()
    {
        if (!$this->propertiesWithDefaultValue) {
            $properties = array_filter($this->getProperties(), function (PropertyContract $property) {
                return !is_null($property->getDefault());
            });

            if ($properties) {
                $this->propertiesWithDefaultValue = array_values($properties);
            }
        }
        return $this->propertiesWithDefaultValue;
    }

    /**
     *
     * Retorna a relacao de meta informações de todas as propriedades que não podem possuir valor nulo
     *
     * @return PropertyContract[]
     */
    public function getPropertiesWithNotNullConstraint()
    {
        if (empty($this->propertiesWithNotNullConstraint)) {
            $properties = array_filter($this->getProperties(), function (PropertyContract $property) {
                return !empty($property->getBehavior()->isRequired()) ? true : false;
            });

            if (!empty($properties)) {
                $this->propertiesWithNotNullConstraint = array_values($properties);
            }
        }
        return $this->propertiesWithNotNullConstraint;
    }
}