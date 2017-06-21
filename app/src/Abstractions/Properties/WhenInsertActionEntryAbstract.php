<?php

namespace Solis\PhpSchema\Abstractions\Properties;

/**
 * Class WhenInsertActionEntryAbstract
 *
 * @package Solis\PhpSchema\Abstractions\Properties
 */
abstract class WhenInsertActionEntryAbstract
{

    /**
     * @var FormatEntryAbstract[]
     */
    protected $before;

    /**
     * @var FormatEntryAbstract[]
     */
    protected $after;

    /**
     * @return FormatEntryAbstract[]
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param FormatEntryAbstract[] $before
     */
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * @param FormatEntryAbstract $format
     */
    public function addBefore(FormatEntryAbstract $format)
    {
        $this->before[] = $format;
    }

    /**
     * @return FormatEntryAbstract[]
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param FormatEntryAbstract[] $after
     */
    public function setAfter($after)
    {
        $this->after = $after;
    }

    /**
     * @param FormatEntryAbstract $format
     */
    public function addAfter(FormatEntryAbstract $format)
    {
        $this->after[] = $format;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        if (!empty($this->getBefore())) {
            $array['before'] = [];
            foreach ($this->getBefore() as $beforeAction) {
                $array['before'][] = $beforeAction->toArray();
            }
        }

        if (!empty($this->getAfter())) {
            $array['after'] = [];
            foreach ($this->getAfter() as $afterAction) {
                $array['after'][] = $afterAction->toArray();
            }
        }

        return $array;
    }
}
