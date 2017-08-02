<?php

namespace Solis\Expressive\Schema\Entries\Behavior;

use Solis\Breaker\TException;
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
     *
     * @throws TException
     */
    public static function make($dados)
    {

        if (!array_key_exists(
            'behavior',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'behavior entry has not been found at json schema',
                400
            );
        }

        switch ($dados['type']) {
            case 'int':
                return IntegerBehavior::make($dados['behavior']);

            default:
                return GenericBehavior::make($dados['behavior']);
        }
    }
}
