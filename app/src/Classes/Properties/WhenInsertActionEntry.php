<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\WhenInsertActionEntryAbstract;

/**
 * Class WhenInsertActionEntry
 *
 * @package Solis\PhpSchema\Classes\Properties
 */
class WhenInsertActionEntry extends WhenInsertActionEntryAbstract
{
    /**
     * @param array $whenInsert
     *
     * @return static
     */
    public static function make($whenInsert)
    {
        $instance = new static();
        if (array_key_exists(
            'before',
            $whenInsert
        )) {
            $before = !is_array($whenInsert['before']) ? [$whenInsert['before']] : $whenInsert['before'];
            foreach (array_values($before) as $format) {
                $instance->addBefore(FormatEntry::make($format));
            }
        }

        if (array_key_exists(
            'after',
            $whenInsert
        )) {
            $after = !is_array($whenInsert['after']) ? [$whenInsert['after']] : $whenInsert['after'];
            foreach (array_values($after) as $format) {
                $instance->addAfter(FormatEntry::make($format));
            }
        }

        return $instance;
    }
}