<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\ActionsEntryAbstract;

/**
 * Class ActionsEntry
 *
 * @package Solis\PhpSchema\Classes\Properties
 */
class ActionsEntry extends ActionsEntryAbstract
{

    /**
     * @param $actions
     *
     * @return static
     */
    public static function make($actions)
    {
        $instance = new static();

        if (array_key_exists(
            'whenInsert',
            $actions
        )) {
            $instance->setWhenInsert(WhenInsertActionEntry::make($actions['whenInsert']));
        }

        return $instance;
    }
}