<?php

namespace Solis\Expressive\Schema\Contracts\Entries\DynamicFunction;

/**
 * Interface DynamicFunctionContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Format
 */
interface DynamicFunctionContract
{

    /**
     * getClass
     *
     * Retorna a classe qual será instanciada como ferramenta de formatação
     *
     * @return string
     */
    public function getClass();

    /**
     * getFunction
     *
     * Retorna o nome da função pertencente a classe instanciada que será chamada para formatação
     *
     * @return string
     */
    public function getFunction();

    /**
     * getParams
     *
     * Retorna os argumentos a serem fornecidos a função de formatação
     *
     * @return array|string
     */
    public function getParams();
}
