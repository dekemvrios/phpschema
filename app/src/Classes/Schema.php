<?php

namespace Solis\PhpSchema\Classes;

use Solis\PhpSchema\Classes\Properties\PropertyEntry;
use Solis\PhpSchema\Abstractions\SchemaAbstract;
use Solis\PhpSchema\Classes\Database\DatabaseEntry;
use Solis\Breaker\TException;

/**
 * Class Schema
 *
 * @package Solis\PhpSchema\Classes
 */
class Schema extends SchemaAbstract
{
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
                "error decoding json schema",
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
        $propertiesEntry = $schema['properties'];

        if (!array_key_exists(
            'database',
            $schema
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'database' field has not been found for defining schema entry",
                500
            );
        }
        $databaseEntry = $schema['database'];

        $instance = new self();
        foreach ($propertiesEntry as $item) {
            $instance->addPropertyEntry(
                PropertyEntry::make($item)
            );
        }
        $instance->setDatabase(
            DatabaseEntry::make($databaseEntry, $instance->getProperties())
        );

        return $instance;
    }
}
