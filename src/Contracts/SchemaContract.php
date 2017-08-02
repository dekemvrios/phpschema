<?php

namespace Solis\Expressive\Schema\Contracts;

use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ContainerContract as DatabaseContainerContract;

/**
 * Interface SchemaContract
 *
 * @package Solis\Expressive\Schema\Contracts
 */
interface SchemaContract
{

    /**
     * getPropertyContainer
     *
     * Retorna o container contendo operações e especificações de propriedades
     *
     * @return PropertyContainerContract
     */
    public function getPropertyContainer();

    /**
     * getDatabaseContainer
     *
     * Retorna o container contendo operações e especificações de database
     *
     * @return DatabaseContainerContract
     */
    public function getDatabaseContainer();

    /**
     * toArray
     *
     * Retorna uma representação em formato de array associativo do schema
     *
     * @param array $properties
     *
     * @return array
     */
    public function toArray($properties = null);

    /**
     * toJson
     *
     * Retorna uma representação em formato json do schema
     *
     * @return string
     */
    public function toJson();
}
