<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\ActionEntryContract;
use Solis\Expressive\Schema\Contracts\Entries\DynamicFunction\DynamicFunctionContract;
use Solis\Expressive\Schema\Entries\DinamycFunction;

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
    private $before = [];

    /**
     * @var DynamicFunctionContract[]
     */
    private $after = [];

    /**
     * @param array $actions
     *
     * @return static
     */
    public static function make($actions)
    {
        $instance = new static();
        if (array_key_exists(
            'before',
            $actions
        )) {
            $before = !is_array($actions['before']) ? [$actions['before']] : $actions['before'];
            foreach (array_values($before) as $format) {
                $instance->addBefore(DinamycFunction::make($format));
            }
        }

        if (array_key_exists(
            'after',
            $actions
        )) {
            $after = !is_array($actions['after']) ? [$actions['after']] : $actions['after'];
            foreach (array_values($after) as $format) {
                $instance->addAfter(DinamycFunction::make($format));
            }
        }

        return $instance;
    }

    /**
     * addBefore
     *
     * Adiciona uma determina ação ao conjunto de ações before
     *
     * @param DynamicFunctionContract $action
     */
    public function addBefore(DynamicFunctionContract $action)
    {
        $this->before[] = $action;
    }

    /**
     * addAfter
     *
     * Adiciona uma determina ação ao conjunto de ações after
     *
     * @param DynamicFunctionContract $action
     */
    public function addAfter(DynamicFunctionContract $action)
    {
        $this->after[] = $action;
    }

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

        if (!empty($this->getBefore())) {
            $array['before'] = [];
            foreach ($this->getBefore() as $beforeAction) {
                $array['before'][] = $beforeAction->toArray();
            }
        }

        if (!empty($this->getAfter())) {
            $array['after'] = [];
            foreach ($this->getAfter() as $afterAction) {
                $array['after'][] = $afterAction->toArray();
            }
        }

        return $array;
    }
}
