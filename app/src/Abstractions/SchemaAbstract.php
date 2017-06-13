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

        return count($entry) > 1 ? $entry : array_values($entry)[0];
    }

    /**
     * getPropertyValueAsList
     *
     * @param string $property
     *
     * @return array|bool
     * @throws TException
     */
    public function getPropertyValueAsList($property)
    {
        if (empty($this->getProperties())) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'properties' entry has not been defined",
                500
            );
        }

        $method = 'get' . ucfirst($property);
        if(!method_exists('Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract', $method)){
            throw new TException(
                __CLASS__,
                __METHOD__,
                "method {$method} has not been defined at SolisPhpSchema\\Abstractions\\Properties\\PropertyEntryAbstract class",
                500
            );
        }

        $list = array_map(function ($item) use ($method){
            $value = $item->{$method}();
            if(!empty($value)){
                return $value;
            }
        }, $this->getProperties());

        if(empty($list)){
            return false;
        }

        return $list;
    }

    /**
     * getDatabaseColumnsAsList
     *
     *
     * @return array|bool
     * @throws TException
     */
    public function getDatabaseColumnsAsList()
    {
        if (empty($this->getDatabase())) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'database' entry has not been defined",
                500
            );
        }

        $list = array_map(function ($item){
            $value = $item->getColumn();
            if(!empty($value)){
                return $value;
            }
        }, $this->getDatabase()->getFields());

        if(empty($list)){
            return false;
        }

        return $list;
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
            $array['database'] = $this->getDatabase()->toArray();
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

