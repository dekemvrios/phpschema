<?php

namespace Solis\Expressive\Schema\Sample;

use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Expressive\Schema\Schema;
use Solis\Breaker\TException;

/**
 * Class Cidade
 *
 * @package Sample\Pessoas
 */
class Cidade
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
     * __construct
     */
    public function __construct()
    {

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json")) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json")
        );
    }

    public static function make()
    {
    }
}
