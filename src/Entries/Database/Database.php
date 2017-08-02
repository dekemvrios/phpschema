<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\DatabaseContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
use Solis\Expressive\Schema\SchemaException;

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
     * DatabaseEntryAbstract constructor.
     *
     * @param string       $table
     * @param string|array $primaryKeys
     */
    protected function __construct(
        $table,
        $primaryKeys
    ) {
        $this->setRepository($table);
        $this->setKeys(!is_array($primaryKeys) ? [$primaryKeys] : $primaryKeys);
    }

    /**
     * make
     *
     * @param array $database
     *
     * @throws SchemaException
     *
     * @return self
     */
    public static function make(
        $database
    ) {
        if (!array_key_exists(
            'repository',
            $database
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'repository' field has not been found for defining database schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'keys',
            $database
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'keys' field has not been found for defining database schema entry ",
                400
            );
        }

        $instance = new self(
            $database['repository'],
            $database['keys']
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
     * @param string $repository
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

    /**
     * toArray
     *
     * Retorna representação em array do registro
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];

        $array['table'] = $this->getRepository();
        $array['primaryKeys'] = $this->getKeys();

        if (!empty($this->getActions())) {
            $array['actions'] = $this->getActions()->toArray();
        }

        return $array;
    }
}
