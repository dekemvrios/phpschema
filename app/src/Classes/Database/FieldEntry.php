<?php

namespace Solis\PhpSchema\Classes\Database;

use Solis\Breaker\TException;
use Solis\PhpSchema\Abstractions\Database\FieldEntryAbstract;

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
     * @param array $dados
     *
     * @return FieldEntry
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
                "field 'property' not found in database source entry schema",
                400
            );
        }

        if (!array_key_exists(
            'column',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "field 'column' not found in database source entry schema",
                400
            );
        }

        return new self(
            $dados['property'],
            $dados['column']
        );
    }
}