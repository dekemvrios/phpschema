<?php

namespace Solis\PhpSchema\Classes\Database;

use Solis\PhpSchema\Abstractions\Database\RelationshipEntryAbstract;
use Solis\PhpSchema\Classes\Database\SourceEntry;
use Solis\Breaker\TException;

/**
 * Class RelationshipEntry
 *
 * @package Solis\PhpSchema\Classes\Database
 */
class RelationshipEntry extends RelationshipEntryAbstract
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
        if (!array_key_exists('type', $dados)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'type' has not been found to set relationship schema",
                400
            );
        }

        if (!array_key_exists('source', $dados)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'source' has not been found to set relationship schema",
                400
            );
        }

        $instance = new static($dados['type'], SourceEntry::make($dados['source']));

        if (array_key_exists('sharedFields', $dados)) {
            $instance->setSharedFields(
                !is_array($dados['sharedFields']) ? [$dados['sharedFields']] : $dados['sharedFields']
            );
        }

        return $instance;
    }
}