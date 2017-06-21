<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\PropertyEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class SchemaEntry
 *
 * @package Solis\PhpSchema\Classes
 */
class PropertyEntry extends PropertyEntryAbstract
{
    /**
     * make
     *
     * @param array $dados
     *
     * @return PropertyEntry
     * @throws TException
     */
    public static function make($dados)
    {
        if (!array_key_exists(
            'property',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'property' field has not been found for defining schema entry",
                400
            );
        }

        if (!array_key_exists(
            'alias',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'alias' field has not been found for defining schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'type',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'type' field has not been found for defining schema entry ",
                400
            );
        }

        $instance = new self(
            $dados['alias'],
            $dados['property'],
            $dados['type']
        );

        if (array_key_exists(
            'format',
            $dados
        )) {
            $format = [];
            foreach ($dados['format'] as $item) {
                $format[] = FormatEntry::make($item);
            }
            $instance->setFormat($format);
        }

        if (array_key_exists(
            'object',
            $dados
        )) {
            $instance->setObject(ObjectEntry::make($dados['object']));
        }

        $instance->setBehavior(BehaviorEntry::make($dados));

        return $instance;
    }
}
