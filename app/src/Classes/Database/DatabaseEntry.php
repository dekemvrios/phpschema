<?php

namespace Solis\PhpSchema\Classes\Database;

use Solis\PhpSchema\Abstractions\Database\DatabaseEntryAbstract;
use Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class DatabaseEntry
 *
 * @package Solis\PhpSchema\Classes\Schema
 */
class DatabaseEntry extends DatabaseEntryAbstract
{

    /**
     * make
     *
     * @param array $database
     * @param PropertyEntryAbstract[] $properties
     *
     * @throws TException
     *
     * @return self
     */
    public static function make(
        $database,
        $properties
    ) {
        if (!array_key_exists(
            'table',
            $database
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'table' field has not been found for defining database schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'primaryKeys',
            $database
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'primaryKeys' field has not been found for defining database schema entry ",
                400
            );
        }
        $primaryKeys = $database['primaryKeys'];

        $instance = new self($database['table'], $primaryKeys);

        if (array_key_exists(
            'fields',
            $database
        )) {
            $fields = $database['fields'];
            foreach ($fields as $databaseEntry) {
                $instance->addField(FieldEntry::make($databaseEntry));
            }
        }

        foreach ($properties as $property) {
            $meta = $instance->getEntry(
                'property',
                $property->getProperty()
            );
            if (empty($meta)) {
                $instance->addField(
                    FieldEntry::make(
                        [
                            "property" => $property->getProperty(),
                            "column"   => $property->getProperty()
                        ]
                    )
                );
            }
        }

        return $instance;
    }
}