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
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'class' => $this->getClass()
        ];

        return $array;
    }
}
