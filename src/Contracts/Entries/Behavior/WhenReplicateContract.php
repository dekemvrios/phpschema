<?php

namespace Solis\Expressive\Schema\Contracts\Entries\Behavior;


/**
 * Class WhenReplicateContract
 *
 * @package Solis\Expressive\Schema\Contracts\Entries\Behavior
 */
interface WhenReplicateContract
{

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return array
     */
    public function toArray();
}