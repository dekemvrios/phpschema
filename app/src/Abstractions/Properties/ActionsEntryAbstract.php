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
     * @var WhenDeleteActionEntryAbstract
     */
    protected $whenDelete;

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
     * @return WhenDeleteActionEntryAbstract
     */
    public function getWhenDelete()
    {
        return $this->whenDelete;
    }

    /**
     * @param WhenDeleteActionEntryAbstract $whenDelete
     */
    public function setWhenDelete($whenDelete)
    {
        $this->whenDelete = $whenDelete;
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

        if (!empty($this->getWhenDelete())) {
            $array['whenDelete'] = $this->getWhenDelete()->toArray();
        }

        return $array;
    }
}
