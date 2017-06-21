<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\ActionsEntryAbstract;
use Solis\PhpSchema\Abstractions\Properties\WhenDeleteActionEntryAbstract;

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

        if (array_key_exists(
            'whenUpdate',
            $actions
        )) {
            $instance->setWhenUpdate(WhenUpdateActionEntry::make($actions['whenUpdate']));
        }

        if (array_key_exists(
            'whenDelete',
            $actions
        )) {
            $instance->setWhenDelete(WhenDeleteActionEntry::make($actions['whenDelete']));
        }

        return $instance;
    }
}