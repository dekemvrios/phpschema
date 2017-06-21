<?php

namespace Solis\PhpSchema\Classes\Database;

use Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract;
use Solis\PhpSchema\Abstractions\Database\FieldEntryAbstract;
use Solis\PhpSchema\Util\Relationships;
use Solis\Breaker\TException;

/**
 * Class SourceEntry
 *
 * @package Solis\PhpSchema\Classes\Schema
 */
class FieldEntry extends FieldEntryAbstract
{

    /**
     * make
     *
     * @param PropertyEntryAbstract $property
     *
     * @return FieldEntry|boolean
     * @throws TException
     */
    public static function make($property)
    {
        $instance = new self(
            $property->getProperty(),
            $property->getProperty()
        );

        if (!empty($property->getObject()) && !empty($property->getObject()->getRelationship())) {
            $meta = Relationships::getMeta($property->getObject()->getRelationship());
            if ($meta['createColumn'] === false) {
                return false;
            }

            $instance->setObject($property->getObject());
        }

        $instance->setBehavior($property->getBehavior());

        return $instance;
    }
}