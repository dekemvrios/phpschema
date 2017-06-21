<?php

namespace Solis\PhpSchema\Abstractions\Database;

use Solis\PhpSchema\Abstractions\Properties\BehaviorEntryAbstract;
use Solis\PhpSchema\Abstractions\Properties\ObjectEntryAbstract;

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
     * @var BehaviorEntryAbstract
     */
    protected $behavior;

    /**
     * @var ObjectEntryAbstract
     */
    protected $object;

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
     * @return ObjectEntryAbstract
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param ObjectEntryAbstract $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return BehaviorEntryAbstract
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * @param BehaviorEntryAbstract $behavior
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            'column'   => $this->getColumn(),
            'property' => $this->getProperty()
        ];

        if (!empty($this->getBehavior())) {
            $array['behavior'] = $this->getBehavior()->toArray();
        }

        if (!empty($this->getObject())) {
            $array['object'] = $this->getObject()->toArray();
        }

        return $array;
    }
}
