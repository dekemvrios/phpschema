<?php

namespace Solis\PhpSchema\Util;

/**
 * Class Relationships
 *
 * @package Solis\PhpSchema\Classes
 */
final class Relationships
{

    /**
     * @var array
     */
    private static $relationships = [
        [
            "name"          => "hasOne",
            "createColumn" => true,
        ],
        [
            "name"          => "hasMany",
            "createColumn" => false,
        ],
    ];

    /**
     * @param string $relationship
     *
     * @return array|bool
     */
    public static function getMeta($relationship)
    {
        $meta = array_filter(self::$relationships, function ($item) use ($relationship) {
            return $item["name"] === $relationship ? true : false;
        });

        return !empty($meta) ? array_values($meta)[0] : false;
    }
}