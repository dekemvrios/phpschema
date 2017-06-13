<?php

namespace Solis\PhpSchema\Abstractions\Properties;

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
     * @var string
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
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * @param string $relationship
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
            $array['relationship'] = $this->getRelationship();
        }

        return $array;
    }
}
