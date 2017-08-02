<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionEntryContract;

/**
 * Class Action
 *
 * @package Solis\Expressive\Schema\Entries\Database
 */
class Action implements ActionContract
{

    /**
     * @var ActionEntryContract
     */
    protected $whenInsert;

    /**
     * @var ActionEntryContract
     */
    protected $whenUpdate;

    /**
     * @var ActionEntryContract
     */
    protected $whenDelete;

    /**
     * @param $actions
     *
     * @return static
     */
    public static function make($actions)
    {
        $instance = new static();

        if (array_key_exists(
            'whenInsert',
            $actions
        )) {
            $instance->setWhenInsert(ActionEntry::make($actions['whenInsert']));
        }

        if (array_key_exists(
            'whenUpdate',
            $actions
        )) {
            $instance->setWhenUpdate(ActionEntry::make($actions['whenUpdate']));
        }

        if (array_key_exists(
            'whenDelete',
            $actions
        )) {
            $instance->setWhenDelete(ActionEntry::make($actions['whenDelete']));
        }

        return $instance;
    }

    /**
     * setWhenInsert
     *
     * Atribui a relação de ações a serem executadas no contexto do insert
     *
     * @param ActionEntryContract $whenInsert
     */
    public function setWhenInsert($whenInsert)
    {
        $this->whenInsert = $whenInsert;
    }

    /**
     * getWhenInsert
     *
     * Retorna a relação de ações a serem executadas no contexto do insert
     *
     * @return ActionEntryContract
     */
    public function getWhenInsert()
    {
        return $this->whenInsert;
    }

    /**
     * setWhenUpdate
     *
     * Retorna a relação de ações a serem executadas no contexto do update
     *
     * @param ActionEntryContract $whenUpdate
     */
    public function setWhenUpdate($whenUpdate)
    {
        $this->whenUpdate = $whenUpdate;
    }

    /**
     * getWhenUpdate
     *
     * Retorna a relação de ações a serem executadas no contexto do update
     *
     * @return ActionEntryContract
     */
    public function getWhenUpdate()
    {
        return $this->whenUpdate;
    }

    /**
     * setWhenDelete
     *
     * Retorna a relação de ações a serem executadas no contexto do delete
     *
     * @param ActionEntryContract $whenDelete
     */
    public function setWhenDelete($whenDelete)
    {
        $this->whenDelete = $whenDelete;
    }

    /**
     * getWhenDelete
     *
     * Retorna a relação de ações a serem executadas no contexto do delete
     *
     * @return ActionEntryContract
     */
    public function getWhenDelete()
    {
        return $this->whenDelete;
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

        if (!empty($this->getWhenInsert())) {
            $array['whenInsert'] = $this->getWhenInsert()->toArray();
        }

        if (!empty($this->getWhenUpdate())) {
            $array['whenUpdate'] = $this->getWhenUpdate()->toArray();
        }

        if (!empty($this->getWhenDelete())) {
            $array['whenDelete'] = $this->getWhenDelete()->toArray();
        }

        return $array;
    }
}