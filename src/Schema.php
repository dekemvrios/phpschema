<?php

namespace Solis\Expressive\Schema;

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
     * @param DatabaseContainerContract $databaseContainer
     */
    protected function __construct(
        $propertyContainer,
        $databaseContainer
    ) {
        $this->serPropertyContainer($propertyContainer);
        $this->setDatabaseContainer($databaseContainer);
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
        throw new TException(
            __CLASS__,
            __METHOD__,
            'method has not been implemented yet!',
            500
        );
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
        throw new TException(
            __CLASS__,
            __METHOD__,
            'method has not been implemented yet!',
            500
        );
    }
}