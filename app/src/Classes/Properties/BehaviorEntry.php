<?php

namespace Solis\PhpSchema\Classes\Properties;

use Solis\PhpSchema\Abstractions\Properties\BehaviorEntryAbstract;

/**
 * Class BehaviorEntry
 *
 * @package Solis\PhpSchema\Classes\Properties
 */
class BehaviorEntry extends BehaviorEntryAbstract
{

    /**
     * make
     *
     * @param $dados
     *
     * @return static
     */
    public static function make($dados)
    {
        $instance = new static();

        $isRequired = true;

        $autoIncrement = false;

        if (array_key_exists(
            'behavior',
            $dados
        )) {
            if (array_key_exists(
                'required',
                $dados['behavior']
            )) {
                $isRequired = $dados['behavior']['required'] === 'true' ? true : false;
            }

            if (array_key_exists(
                'autoIncrement',
                $dados['behavior']
            )) {
                $autoIncrement = $dados['behavior']['autoIncrement'] === 'true' ? true : false;
            }
        }

        $instance->setRequired($isRequired);
        $instance->setAutoIncrement($autoIncrement);

        return $instance;
    }
}
