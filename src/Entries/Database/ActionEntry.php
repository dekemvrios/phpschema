<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\ActionEntryContract;
use Solis\Expressive\Schema\Contracts\Entries\DynamicFunction\DynamicFunctionContract;

/**
 * Class ActionEntry
 *
 * @package Solis\Expressive\Schema\Entries\Database
 */
class ActionEntry implements ActionEntryContract
{

    /**
     * @var DynamicFunctionContract[]
     */
    private $before;

    /**
     * @var DynamicFunctionContract[]
     */
    private $after;

    /**
     * setBefore
     *
     * Atribui a relação de funções dinâmicas a serem executadas antes da operação
     *
     * @param DynamicFunctionContract[] $before
     */
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * getBefore
     *
     * Retorna a relação de funções dinâmicas a serem executadas antes da operação
     *
     * @return DynamicFunctionContract[]
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * setAfter
     *
     * Atribui a relação de funções dinâmicas a serem executadas após da operação
     *
     * @param DynamicFunctionContract[] $after
     */
    public function setAfter($after)
    {
        $this->after = $after;
    }

    /**
     * getAfter
     *
     * Retorna a relação de funções dinâmicas a serem executadas após da operação
     *
     * @return DynamicFunctionContract[]
     */
    public function getAfter()
    {
        return $this->after;
    }
}