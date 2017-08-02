<?php

namespace Solis\PhpSchema\Sample\Classes;

use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Expressive\Schema\Schema;

//use Solis\PhpSchema\Contracts\SchemaContract;
//use Solis\PhpSchema\Classes\Schema;
use Solis\Breaker\TException;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Schema\Classes
 */
class Estado
{
    /**
     * @var SchemaContract
     */
    public $schema;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $codigoIbge;

    /**
     * @var string
     */
    protected $cidade;

    /**
     * @var string
     */
    protected $capital;

    /**
     * __construct
     *
     */
    public function __construct()
    {

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")
        );
    }
}