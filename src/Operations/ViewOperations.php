<?php

namespace Solis\Expressive\Schema\Operations;

/**
 * Trait ViewOperations
 *
 * @package Solis\Expressive\Operations
 */
trait ViewOperations
{
    /**
     * toArray
     *
     * Retorna uma representação em formato de array associativo do schema
     *
     * @param array $properties
     *
     * @return array
     */
    public function toArray($properties = null)
    {
        $array = [];

        if (!empty($this->getMeta())) {
            $array['meta'] = $this->getMeta();
        }

        if (!empty($this->getPropertyContainer())) {
            $array['properties'] = [];

            foreach ($this->getPropertyContainer()->getProperties() as $item) {
                if (method_exists(
                    $item,
                    'toArray'
                )) {
                    $array['properties'][] = $item->toArray();
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