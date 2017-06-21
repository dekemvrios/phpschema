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
     * @return array
     */
    public function toArray()
    {
        $array = [];

        if (!empty($this->getWhenInsert())) {
            $array['whenInsert'] = $this->getWhenInsert()->toArray();
        }

        return $array;
    }
}
