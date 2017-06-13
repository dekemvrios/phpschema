<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\ObjectEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class ObjectEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class ObjectEntry extends ObjectEntryAbstract
{

    /**
     * make
     *
     * @param $class
     *
     * @return static
     * @throws TException
     */
    public static function make($class)
    {
        if (!array_key_exists(
            'class',
            $class
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'class' field has not been found for defining 'object' schema entry",
                400
            );
        }

        if (!class_exists($class['class'])) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "class {$class['class']} has not been defined",
                400
            );
        }

        if (!method_exists(
            $class['class'],
            'make'
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "a 'class' defined in the 'object' schema entry must have a make method",
                400
            );
        }

        $instance = new static(
            $class['class']
        );

        if (array_key_exists(
            'relationship',
            $class
        )) {
            $instance->setRelationship($class['relationship']);
        }

        return $instance;
    }
}
