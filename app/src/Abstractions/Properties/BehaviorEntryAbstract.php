<?php

namespace Solis\PhpSchema\Abstractions\Properties;

/**
 * Class BehaviorEntryAbstract
 *
 * @package Solis\PhpSchema\Abstractions\Properties
 */
abstract class BehaviorEntryAbstract
{

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var ActionsEntryAbstract
     */
    protected $actions;

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return ActionsEntryAbstract
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param ActionsEntryAbstract $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * toArray
     */
    public function toArray()
    {
        $array = [
            'required' => $this->isRequired()
        ];

        if (!empty($this->getActions())) {
            $array['actions'] = $this->getActions()->toArray();
        }
        return $array;
    }
}
