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
     * toArray
     */
    public function toArray()
    {
        return [
            'required' => $this->isRequired()
        ];
    }
}
