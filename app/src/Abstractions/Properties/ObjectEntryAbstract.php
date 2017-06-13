<?php

namespace Solis\PhpSchema\Abstractions\Properties;

use Solis\PhpSchema\Abstractions\Database\RelationshipEntryAbstract;

/**
 * Class ObjectEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Properties
 */
abstract class ObjectEntryAbstract
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var RelationshipEntryAbstract
     */
    protected $relationship;

    /**
     * __construct
     *
     * @param string $class
     */
    protected function __construct(
        $class
    ) {
        $this->setClass($class);
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return RelationshipEntryAbstract
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * @param RelationshipEntryAbstract $relationship
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'class' => $this->getClass()
        ];

        if (!empty($this->getRelationship())) {
            $array['relationship'] = $this->getRelationship()->toArray();
        }

        return $array;
    }
}
