<?php

namespace Solis\Expressive\Schema\Entries\Behavior;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;
use Solis\Expressive\Schema\Contracts\Entries\Behavior\WhenReplicateContract;

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
     * @var boolean
     */
    private $hidden;

    /**
     * @var WhenReplicateContract
     */
    private $whenReplicate;

    /**
     * GenericBehavior constructor.
     *
     * @param array $dados
     */
    public function __construct($dados = [])
    {
        $this->setRequired(
            array_key_exists(
                'required',
                $dados
            ) ? $dados['required'] : true
        );
        $this->setHidden(
            array_key_exists(
                'hidden',
                $dados
            ) ? $dados['hidden'] : false
        );

        $whenReplicate = array_key_exists('whenReplicate', $dados) ? $dados['whenReplicate'] : [];

        $this->setWhenReplicate(
                new WhenReplicate($whenReplicate)
        );
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
        if (is_string($required)) {
            $required = $required === 'true' ? true : false;
        }
        $this->required = $required;
    }

    /**
     * setHidden
     *
     * Retorna valor lógico indicando se o registro será ocultado ou não
     *
     * @param boolean $hidden
     */
    public function setHidden($hidden)
    {
        if (is_string($hidden)) {
            $hidden = $hidden === 'true' ? true : false;
        }
        $this->hidden = $hidden;
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
     * isHidden
     *
     * Retorna valor lógico indicando se o registro será ocultado ou não
     *
     * @return boolean
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * @return WhenReplicateContract
     */
    public function getWhenReplicate()
    {
        return $this->whenReplicate;
    }

    /**
     * @param WhenReplicateContract $whenReplicate
     */
    public function setWhenReplicate($whenReplicate)
    {
        $this->whenReplicate = $whenReplicate;
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
            'required'      => $this->isRequired(),
            'hidden'        => $this->isHidden(),
            'whenReplicate' => $this->getWhenReplicate()->toArray(),
        ];
    }
}
