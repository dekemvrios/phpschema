<?php

namespace Solis\PhpSchema\Abstractions;

use Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract;
use Solis\PhpSchema\Abstractions\Database\DatabaseEntryAbstract;
use Solis\PhpSchema\Contracts\SchemaContract;
use Solis\Breaker\TException;

/**
 * Class SchemaAbstract
 *
 * @package Solis\PhpSchema\Abstractions
 */
abstract class SchemaAbstract implements SchemaContract
{

    /**
     * @var PropertyEntryAbstract[]
     */
    protected $properties;

    /**
     * @var DatabaseEntryAbstract
     */
    protected $database;

    /**
     * __construct
     *
     * @param array $properties
     * @param array $database
     */
    protected function __construct(
        $properties = [],
        $database = []
    ) {
        $this->properties = $properties;
        $this->database = $database;
    }

    /**
     * @param PropertyEntryAbstract[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return PropertyEntryAbstract[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param DatabaseEntryAbstract $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * @return DatabaseEntryAbstract
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * addEntry
     *
     * @param PropertyEntryAbstract $property
     */
    public function addPropertyEntry($property)
    {
        $this->properties[] = $property;
    }

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
    ) {
        if (empty($this->getProperties())) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'properties' entry has not been defined",
                500
            );
        }

        $entry = array_filter($this->getProperties(), function ($item) use ($key, $value) {
                if (!method_exists(
                    $item,
                    'get' . ucfirst($key)
                )
                ) {
                    throw new TException(
                        __CLASS__,
                        __METHOD__,
                        'method ' . 'get' . ucfirst($key) . ' not found at ' . get_class($item),
                        400
                    );
                }
                return $item->{'get' . ucfirst($key)}() === $value ? true : false;
            }
        );

        if(empty($entry)){
            return false;
        }

        return count($entry) > 1 ? $entry : $entry[0];
    }

    /**
     * toArray
     *
     * @param array $properties
     *
     * @return array
     */
    public function toArray($properties = null)
    {
        $array = [];
        if (!empty($this->getProperties())) {
            $array['properties'] = [];

            foreach ($this->getProperties() as $item) {
                if (method_exists(
                    $item,
                    'toArray'
                )) {
                    $array['properties'][] = $item->toArray(!empty($properties) ? $properties : null);
                }
            }
        }
        if (!empty($this->getDatabase())) {
            $array['database'] = [
                'table' => $this->getDatabase()->getTable()
            ];
            if (!empty($this->getDatabase()->getFields())) {
                $array['database']['fields'] = [];
                foreach ($this->getDatabase()->getFields() as $field) {
                    if (method_exists(
                        $field,
                        'toArray'
                    )) {
                        $array['database']['fields'][] = $field->toArray();
                    }
                }
            }
        }
        return $array;
    }

    /**
     * toJson
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

