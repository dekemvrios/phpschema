<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\WhenUpdateActionEntryAbstract;

/**
 * Class WhenUpdateActionEntry
 *
 * @package Solis\PhpSchema\Classes\Properties
 */
class WhenUpdateActionEntry extends WhenUpdateActionEntryAbstract
{
    /**
     * @param array $whenUpdate
     *
     * @return static
     */
    public static function make($whenUpdate)
    {
        $instance = new static();
        if (array_key_exists(
            'before',
            $whenUpdate
        )) {
            $before = !is_array($whenUpdate['before']) ? [$whenUpdate['before']] : $whenUpdate['before'];
            foreach (array_values($before) as $format) {
                $instance->addBefore(FormatEntry::make($format));
            }
        }

        if (array_key_exists(
            'after',
            $whenUpdate
        )) {
            $after = !is_array($whenUpdate['after']) ? [$whenUpdate['after']] : $whenUpdate['after'];
            foreach (array_values($after) as $format) {
                $instance->addAfter(FormatEntry::make($format));
            }
        }

        return $instance;
    }
}