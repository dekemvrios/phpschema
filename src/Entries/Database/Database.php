<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\DatabaseContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
use Solis\Breaker\TException;

/**
 * Class Database
 *
 * @package Solis\Expressive\Schema\Entries\Database
 */
class Database implements DatabaseContract
{
    /**
     * @var string
     */
    private $repository;

    /**
     * @var array
     */
    private $keys;

    /**
     * @var ActionContract
     */
    private $actions;

    /**
     * make
     *
     * @param array $database
     *
     * @throws TException
     *
     * @return self
     */
    public static function make(
        $database
    ) {
        if (!array_key_exists(
            'table',
            $database
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'table' field has not been found for defining database schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'primaryKeys',
            $database
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "'primaryKeys' field has not been found for defining database schema entry ",
                400
            );
        }
        $primaryKeys = $database['primaryKeys'];

        $instance = new self(
            $database['table'],
            $primaryKeys
        );

        if (array_key_exists(
            'actions',
            $database
        )) {
            $instance->setActions(Action::make($database['actions']));
        }

        return $instance;
    }

    /**
     * setRepository
     *
     * Atribui Nome da fonte qual está contido os dados do active record a ser manipulado
     *
     * @param array $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * getRepository
     *
     * Nome da fonte qual está contido os dados do active record a ser manipulado
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * setKeys
     *
     * Atribui Relação de chaves utilizadas como identificador do registro na persistência
     *
     * @param array $keys
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
    }

    /**
     * getKeys
     *
     * Relação de chaves utilizadas como identificador do registro na persistência
     *
     * @return string|array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * setActions
     *
     * @param ActionContract $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * getActions
     *
     * Relação de acoes utilizadas no contexto das operações de persistencia do registro
     *
     * @return ActionContract
     */
    public function getActions()
    {
        return $this->actions;
    }
}