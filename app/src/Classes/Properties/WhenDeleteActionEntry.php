<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\WhenDeleteActionEntryAbstract;

/**
 * Class WhenUpdateActionEntry
 *
 * @package Solis\PhpSchema\Classes\Properties
 */
class WhenDeleteActionEntry extends WhenDeleteActionEntryAbstract
{
    /**
     * @param array $whenDelete
     *
     * @return static
     */
    public static function make($whenDelete)
    {
        $instance = new static();
        if (array_key_exists(
            'before',
            $whenDelete
        )) {
            $before = !is_array($whenDelete['before']) ? [$whenDelete['before']] : $whenDelete['before'];
            foreach (array_values($before) as $format) {
                $instance->addBefore(FormatEntry::make($format));
            }
        }

        if (array_key_exists(
            'after',
            $whenDelete
        )) {
            $after = !is_array($whenDelete['after']) ? [$whenDelete['after']] : $whenDelete['after'];
            foreach (array_values($after) as $format) {
                $instance->addAfter(FormatEntry::make($format));
            }
        }

        return $instance;
    }
}