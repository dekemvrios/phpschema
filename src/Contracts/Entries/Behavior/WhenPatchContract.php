<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;

/**
 * Interface WhenPatchContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface WhenPatchContract
{

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return array
     */
    public function toArray();
}