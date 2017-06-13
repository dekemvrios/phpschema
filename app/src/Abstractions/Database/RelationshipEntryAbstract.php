<?php

namespace Solis\PhpSchema\Abstractions\Database;

/**
 * Class RelationshipEntryAbstract
 *
 * @package Solis\PhpSchema\Abstractions\Properties
 */
abstract class RelationshipEntryAbstract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var SourceEntryAbstract
     */
    protected $source;

    /**
     * @var array
     */
    protected $sharedFields;

    /**
     * RelationshipEntryAbstract constructor.
     *
     * @param string              $type
     * @param SourceEntryAbstract $source
     */
    protected function __construct($type, $source)
    {
        $this->setType($type);
        $this->setSource($source);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return SourceEntryAbstract
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param SourceEntryAbstract $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return array
     */
    public function getSharedFields()
    {
        return $this->sharedFields;
    }

    /**
     * @param array $sharedFields
     */
    public function setSharedFields($sharedFields)
    {
        $this->sharedFields = $sharedFields;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            "type" => $this->getType(),
            "source" => $this->getSource()->toArray()
        ];

        if (!empty($this->getSharedFields())) {
            $array['sharedFields'] = $this->getSharedFields();
        }

        return $array;
    }

}
