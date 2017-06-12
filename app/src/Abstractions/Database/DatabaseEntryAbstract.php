<?php

namespace Solis\PhpSchema\Abstractions\Database;

use Solis\Breaker\TException;

/**
 * Class DatabaseEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class DatabaseEntryAbstract
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var FieldEntryAbstract[]
     */
    protected $fields = [];

    /**
     * DatabaseEntryAbstract constructor.
     *
     * @param string $table
     */
    protected function __construct($table)
    {
        $this->setTable($table);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return FieldEntryAbstract[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param FieldEntryAbstract[] $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param FieldEntryAbstract $field
     */
    public function addField($field)
    {
        $this->fields[] = $field;
    }

    /**
     * getEntry
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return array|bool
     *
     * @throws TException
     */
    public function getEntry(
        $key,
        $value
    ) {
        if(empty($this->getFields())){
            return false;
        }

        $entry = array_filter($this->getFields(), function ($item) use ($key, $value) {
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
        });

        if(empty($entry)){
            return false;
        }

        return count($entry) < 1 ? $entry[0] : $entry;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        $array['table'] = $this->getTable();
        if (!empty($this->getFields())) {
            $array['fields'] = [];
            foreach ($this->getFields() as $field) {
                $array['fields'][] = $field->toArray();
            }
        }
        return $array;
    }
}
