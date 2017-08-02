<?php

namespace Solis\Expressive\Schema\Entries\Composition;

use Solis\Expressive\Schema\Contracts\Entries\Composition\SourceContract;
use Solis\Breaker\TException;

/**
 * Class Source
 *
 * @package Solis\Expressive\Schema\Entries\Composition
 */
class Source implements SourceContract
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $refers;

    /**
     * @param array $dados
     *
     * @return static
     *
     * @throws TException
     */
    public static function make($dados)
    {

        if (!array_key_exists(
            'field',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'field' has not been found to set source schema",
                400
            );
        }

        if (!array_key_exists(
            'refers',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema entry 'refers' has not been found to set source schema",
                400
            );
        }

        return new static(
            $dados['field'],
            $dados['refers']
        );
    }

    /**
     * setField
     *
     * Atribui o nome da propriedade no active record que contém o valor do campo relacionamento
     *
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * getField
     *
     * Retorna o nome da propriedade no active record que contém o valor do campo relacionamento
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * setRefers
     *
     * Atribui o nome da propriedade na composião que contém o valor do campo relacionamento
     *
     * @param $refers
     */
    public function setRefers($refers)
    {
        $this->refers = $refers;
    }

    /**
     * getRefers
     *
     * Retorna o nome da propriedade na composião que contém o valor do campo relacionamento
     *
     * @return string
     */
    public function getRefers()
    {
        return $this->refers;
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
        return [
            'field'  => $this->getField(),
            'refers' => $this->getRefers(),
        ];
    }
}