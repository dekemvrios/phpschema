<?php

namespace Solis\Expressive\Schema\Operations;

use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ContainerContract as DatabaseContainerContract;

/**
 * Trait ContainerOperations
 *
 * @package Solis\Expressive\Operations
 */
trait ContainerOperations
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
     * setPropertyContainer
     *
     * Atribui o container contendo operações e especificações de propriedades
     *
     * @param PropertyContainerContract $propertyContainer
     */
    public function setPropertyContainer($propertyContainer)
    {
        $this->propertyContainer = $propertyContainer;
    }

    /**
     * getPropertyContainer
     *
     * Retorna o container contendo operações e especificações de propriedades
     *
     * @return PropertyContainerContract
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
     */
    public function getDatabaseContainer()
    {
        return $this->databaseContainer;
    }
}