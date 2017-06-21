<?php

namespace Solis\PhpSchema\Abstractions\Properties;

/**
 * Class ActionsEntryAbstract
 *
 * @package Solis\PhpSchema\Abstractions\Properties
 */
abstract class ActionsEntryAbstract
{

    /**
     * @var WhenInsertActionEntryAbstract
     */
    protected $whenInsert;

    /**
     * @var WhenUpdateActionEntryAbstract
     */
    protected $whenUpdate;

    /**
     * @return WhenInsertActionEntryAbstract
     */
    public function getWhenInsert()
    {
        return $this->whenInsert;
    }

    /**
     * @param WhenInsertActionEntryAbstract $whenInsert
     */
    public function setWhenInsert($whenInsert)
    {
        $this->whenInsert = $whenInsert;
    }

    /**
     * @return WhenUpdateActionEntryAbstract
     */
    public function getWhenUpdate()
    {
        return $this->whenUpdate;
    }

    /**
     * @param WhenUpdateActionEntryAbstract $whenUpdate
     */
    public function setWhenUpdate($whenUpdate)
    {
        $this->whenUpdate = $whenUpdate;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        if (!empty($this->getWhenInsert())) {
            $array['whenInsert'] = $this->getWhenInsert()->toArray();
        }

        if (!empty($this->getWhenUpdate())) {
            $array['whenUpdate'] = $this->getWhenUpdate()->toArray();
        }

        return $array;
    }
}
