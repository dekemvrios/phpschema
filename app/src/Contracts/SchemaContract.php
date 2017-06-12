<?php

namespace Solis\PhpSchema\Contracts;

use Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract;
use Solis\PhpSchema\Abstractions\Database\DatabaseEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class SchemaAbstract
 *
 * @package Solis\PhpSchema\Abstractions
 */
interface SchemaContract
{

    /**
     * @param PropertyEntryAbstract[] $properties
     *
     * @throws TException
     */
    public function setProperties($properties);

    /**
     * @return PropertyEntryAbstract[]
     *
     * @throws TException
     */
    public function getProperties();

    /**
     * @param DatabaseEntryAbstract $database
     */
    public function setDatabase($database);

    /**
     * @return DatabaseEntryAbstract
     *
     * @throws TException
     */
    public function getDatabase();

    /**
     * addEntry
     *
     * @param PropertyEntryAbstract $property
     *
     * @throws TException
     */
    public function addPropertyEntry($property);

    /**
     * getPropertyEntry
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return array|bool
     *
     * @throws TException
     */
    public function getPropertyEntry(
        $key,
        $value
    );

    /**
     * toArray
     *
     * @param array $properties
     *
     * @return array
     *
     * @throws TException
     */
    public function toArray($properties = null);

    /**
     * toJson
     *
     * @return string
     *
     * @throws TException
     */
    public function toJson();
}
