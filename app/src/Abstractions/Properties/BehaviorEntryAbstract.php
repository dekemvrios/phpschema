<?php

namespace Solis\PhpSchema\Abstractions\Properties;

/**
 * Class BehaviorEntryAbstract
 *
 * @package Solis\PhpSchema\Abstractions\Properties
 */
abstract class BehaviorEntryAbstract
{

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var boolean
     */
    protected $autoIncrement;

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return bool
     */
    public function isAutoIncrement()
    {
        return $this->autoIncrement;
    }

    /**
     * @param bool $autoIncrement
     */
    public function setAutoIncrement($autoIncrement)
    {
        $this->autoIncrement = $autoIncrement;
    }

    /**
     * toArray
     */
    public function toArray()
    {
        $array = [
            'required'      => $this->isRequired(),
            'autoIncrement' => $this->isAutoIncrement()
        ];

        return $array;
    }
}
