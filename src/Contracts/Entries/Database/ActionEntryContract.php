<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\DynamicFunction\DynamicFunctionContract;

/**
 * Interface ActionEntryContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Database
 */
interface ActionEntryContract
{

    /**
     * before
     *
     * Retorna a relação de funções dinâmicas a serem executadas antes da operação
     *
     * @return DynamicFunctionContract[]
     */
    public function getBefore();

    /**
     * after
     *
     * Retorna a relação de funções dinâmicas a serem executadas após da operação
     *
     * @return DynamicFunctionContract[]
     */
    public function getAfter();
}
