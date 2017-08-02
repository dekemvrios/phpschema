<?php

namespace Solis\Expressive\Schema;

use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Breaker\Classes\TInfo;

/**
 * Class SchemaException
 *
 * @package Solis\Expressive\Schema
 */
class SchemaException extends TExceptionAbstract
{
    /**
     * __construct
     *
     * @param mixed $class  class name
     * @param mixed $method method name
     * @param mixed $reason explanation for TException
     * @param mixed $code   error code
     */
    public function __construct(
        $class,
        $method,
        $reason,
        $code
    ) {
        // create new Tinfo object to store default TException information
        $error = Tinfo::build(
            [
                'code'    => $code,
                'message' => $reason,
            ]
        );

        // create new Tinfo object to store debug TException information
        $debug = Tinfo::build(
            [
                'class'  => $class,
                'method' => $method,
                'trace'  => $this->getTrace(),
            ]
        );

        parent::__construct(
            $error,
            $debug
        );
    }
}