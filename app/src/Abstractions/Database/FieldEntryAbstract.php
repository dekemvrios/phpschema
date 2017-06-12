<?php

namespace Solis\PhpSchema\Abstractions\Database;

/**
 * Class SourceEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class FieldEntryAbstract
{
    /**
     * @var string
     */
    protected $property;

    /**
     * @var string
     */
    protected $column;

    /**
     * __construct
     *
     * @param string $property
     * @param string $column
     */
    protected function __construct(
        $property,
        $column
    ) {
        $this->setProperty($property);
        $this->setColumn($column);
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param string $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'column'   => $this->getColumn(),
            'property' => $this->getProperty()
        ];
    }
}
