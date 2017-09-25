<?php

namespace Solis\Expressive\Schema\Entries\Behavior;


use Solis\Expressive\Schema\Contracts\Entries\Behavior\WhenPatchContract;

/**
 * Class WhenPatch
 *
 * @package Solis\Expressive\Schema\Entries\Behavior
 */
class WhenPatch implements WhenPatchContract
{

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $validActions = ['keep', 'update'];

    /**
     * WhenReplicate constructor.
     *
     * @param array $dados
     */
    public function __construct($dados = [])
    {
        $action = array_key_exists('action', $dados) ? $dados['action'] : 'update';

        $action = in_array($action, $this->validActions) ? $action : 'update';

        $this->setAction($action);
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
     * @return array
     */
    public function toArray()
    {
        return [
                'action' => $this->getAction(),
        ];
    }
}