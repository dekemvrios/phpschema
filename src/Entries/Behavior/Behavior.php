<?php

namespace Solis\Expressive\Schema\Entries\Behavior;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;

/**
 * Class Behavior
 *
 * @package Solis\Expressive\Schema\Entries\Behavior
 */
class Behavior
{

    /**
     * make
     *
     * @param array $dados
     *
     * @return GenericContract
     */
    public static function make($dados)
    {

        $behavior = array_key_exists(
            'behavior',
            $dados
        ) ? $dados['behavior'] : [];

        switch ($dados['type']) {
            case 'int':
                return new IntegerBehavior($behavior);
        }

        return new GenericBehavior($behavior);
    }
}
