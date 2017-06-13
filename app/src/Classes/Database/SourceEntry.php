<?php

namespace Solis\PhpSchema\Classes\Database;

use Solis\PhpSchema\Abstractions\Database\SourceEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class SourceEntry
 *
 * @package Solis\PhpSchema\Classes\Database
 */
class SourceEntry extends SourceEntryAbstract
{


    /**
     * @param array $dados
     *
     * @return static
     *
     * @throws TException
     */
    public static function make($dados)
    {

        if (!array_key_exists('field', $dados)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'field' has not been found to set source schema",
                400
            );
        }

        if (!array_key_exists('refers', $dados)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'refers' has not been found to set source schema",
                400
            );
        }

        return new static(
            $dados['field'],
            $dados['refers']
        );
    }

}