<?php

namespace Solis\Expressive\Schema;

use Solis\Expressive\Schema\Operations\{
    PropertiesOperations,
    ContainerOperations,
    DatabaseOperations,
    MetaOperations,
    ViewOperations
};
use Solis\Expressive\Schema\Containers\{
    DatabaseContainer, PropertyCotainer
};
use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;

/**
 * Class Schema
 *
 * @package Solis\Expressive\Schema
 */
class Schema implements SchemaContract
{

    use ContainerOperations;
    use PropertiesOperations;
    use DatabaseOperations;
    use ViewOperations;
    use MetaOperations;

    /**
     * Schema constructor.
     *
     * @param PropertyContainerContract $propertyContainer
     */
    protected function __construct(
        $propertyContainer
    ) {
        $this->setPropertyContainer($propertyContainer);
    }

    /**
     * make
     *
     * @param string $json
     *
     * @return SchemaContract
     * @throws SchemaException
     */
    public static function make($json)
    {
        $schema = json_decode(
            $json,
            true
        );
        if (!$schema) {
            throw new SchemaException(
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
            throw new SchemaException(
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
                    $schema['database'],
                    $instance->getPropertyContainer()
                )
            );
        }

        if (array_key_exists(
            'meta',
            $schema
        )) {
            $instance->setMeta($schema['meta']);
        }

        return $instance;
    }
}
