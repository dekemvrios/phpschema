<?php

namespace Solis\PhpSchema\Abstractions\Database;

/**
 * Class SourceEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class SourceEntryAbstract
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $refers;

    /**
     * __construct
     *
     * @param string $field
     * @param string $refers
     */
    protected function __construct(
        $field,
        $refers
    ) {
        $this->setField($field);
        $this->setRefers($refers);
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getRefers()
    {
        return $this->refers;
    }

    /**
     * @param string $refers
     */
    public function setRefers($refers)
    {
        $this->refers = $refers;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'field' => $this->getField(),
            'refers' => $this->getRefers()
        ];
    }
}
