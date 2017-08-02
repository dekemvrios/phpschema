<?php

namespace Solis\Expressive\Schema\Entries\Behavior;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;

/**
 * Class GenericBehavior
 *
 * @package Solis\Expressive\Schema\Entries\Behavior
 */
class GenericBehavior implements GenericContract
{
    /**
     * @var boolean
     */
    private $required;

    /**
     * make
     *
     * @param array $dados
     *
     * @return GenericContract
     */
    public static function make($dados = [])
    {
        $instance = new static();
        $instance->setRequired(
            array_key_exists(
                'required',
                $dados
            ) ? $dados['required'] : true
        );

        return $instance;
    }

    /**
     * setRequired
     *
     * Retorna valor lógico indicando a obrigatóriedade de utilização do registro
     *
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * isRequired
     *
     * Retorna valor lógico indicando a obrigatóriedade de utilização do registro
     *
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
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
            'required' => $this->isRequired(),
        ];
    }
}
