<?php

namespace Solis\Expressive\Schema\Entries\Behavior;


use Solis\Expressive\Schema\Contracts\Entries\Behavior\WhenReplicateContract;

/**
 * Class WhenReplicate
 *
 * @package Solis\Expressive\Schema\Entries\Behavior
 */
class WhenReplicate implements WhenReplicateContract
{

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $validActions = ['keep', 'clean', 'last+1', 'static'];

    /**
     * @var string
     */
    private $value;

    /**
     * WhenReplicate constructor.
     *
     * @param array $dados
     */
    public function __construct($dados = [])
    {
        $action = $dados['action'] ?? 'keep';

        if (in_array($action, $this->validActions)) {
            $this->setAction($action);
        }

        $this->setValue($dados['value'] ?? null);
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'action' => $this->getAction(),
            'value'  => $this->getValue(),
        ];
    }
}