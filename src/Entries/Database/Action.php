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
}