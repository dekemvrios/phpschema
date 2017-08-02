<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Property;

/**
 * Interface PropertyContainerContract
 *
 * @package Solis\Expressive\Schema\Contracts
 */
interface ContainerContract
{

    /**
     * getProperties
     *
     * Retorna a relação de propriedades do active record
     *
     * @return PropertyContract[]
     */
    public function getProperties();
}
