<?php

namespace Solis\Expressive\Schema;

use Solis\Expressive\Schema\Containers\DatabaseContainer;
use Solis\Expressive\Schema\Containers\PropertyCotainer;
use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ContainerContract as DatabaseContainerContract;
use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Breaker\TException;

/**
 * Class Schema
 *
 * @package Solis\Expressive\Schema
 */
class Schema implements SchemaContract
{
    /**
     * @var PropertyContainerContract
     */
    private $propertyContainer;

    /**
     * @var DatabaseContainerContract
     */
    private $databaseContainer;

    /**
     * Schema constructor.
     *
     * @param PropertyContainerContract $propertyContainer
     */
    protected function __construct(
        $propertyContainer
    ) {
        $this->serPropertyContainer($propertyContainer);
    }

    /**
     * make
     *
     * @param string $json
     *
     * @return Schema
     * @throws TException
     */
    public static function make($json)
    {
        $schema = json_decode(
            $json,
            true
        );
        if (!$schema) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "Error decoding json file while creating schema",
                500
            );
        }

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


        $instance = new self(
            PropertyCotainer::make(
                $schema['properties']
            )
        );

        if (array_key_exists(
            'database',
            $schema
        )
        ) {
            $instance->setDatabaseContainer(
                DatabaseContainer::make(
                    $schema['database']
                )
            );
        }

        return $instance;
    }

    /**
     * setPropertyContainer
     *
     * Atribui o container contendo operações e especificações de propriedades
     *
     * @param PropertyContainerContract $propertyContainer
     */
    public function serPropertyContainer($propertyContainer)
    {
        $this->propertyContainer = $propertyContainer;
    }

    /**
     * getPropertyContainer
     *
     * Retorna o container contendo operações e especificações de propriedades
     *
     * @return PropertyContainerContract
     *
     * @throws TException
     */
    public function getPropertyContainer()
    {
        return $this->propertyContainer;
    }

    /**
     * setDatabaseContainer
     *
     * Atribui o container contendo operações e especificações de database
     *
     * @param DatabaseContainerContract $databaseContainer
     */
    public function setDatabaseContainer($databaseContainer)
    {
        $this->databaseContainer = $databaseContainer;
    }

    /**
     * getDatabaseContainer
     *
     * Retorna o container contendo operações e especificações de database
     *
     * @return DatabaseContainerContract
     *
     * @throws TException
     */
    public function getDatabaseContainer()
    {
        return $this->databaseContainer;
    }

    /**
     * toArray
     *
     * Retorna uma representação em formato de array associativo do schema
     *
     * @param array $properties
     *
     * @return array
     *
     * @throws TException
     */
    public function toArray($properties = null)
    {
        $array = [];
        if (!empty($this->getPropertyContainer())) {
            $array['properties'] = [];

            foreach ($this->getPropertyContainer()->getProperties() as $item) {
                if (method_exists(
                    $item,
                    'toArray'
                )) {
                    $array['properties'][] = $item->toArray(!empty($properties) ? $properties : null);
                }
            }
        }
        if (!empty($this->getDatabaseContainer())) {
            $array['database'] = $this->getDatabaseContainer()->getDatabase()->toArray();
        }

        return $array;
    }

    /**
     * toJson
     *
     * Retorna uma representação em formato json do schema
     *
     * @return string
     *
     * @throws TException
     */
    public function toJson()
    {
        $json = null;
        if (!empty($this->toArray())) {
            $json = json_encode($this->toArray());
        }

        return $json;
    }
}