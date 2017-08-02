<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

/**
 * Interface ActionContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Database
 */
interface ActionContract
{

    /**
     * getWhenInsert
     *
     * Retorna a relação de ações a serem executadas no contexto do insert
     *
     * @return ActionEntryContract
     */
    public function getWhenInsert();

    /**
     * getWhenUpdate
     *
     * Retorna a relação de ações a serem executadas no contexto do update
     *
     * @return ActionEntryContract
     */
    public function getWhenUpdate();

    /**
     * getWhenDelete
     *
     * Retorna a relação de ações a serem executadas no contexto do delete
     *
     * @return ActionEntryContract
     */
    public function getWhenDelete();
}