<?php
namespace Solis\PhpSchema\Abstractions\Properties;

/**
 * Class SchemaEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Properties
 */
abstract class PropertyEntryAbstract
{

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $property;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var BehaviorEntryAbstract
     */
    protected $behavior;

    /**
     * @var FormatEntryAbstract[]
     */
    protected $format;

    /**
     * @var ObjectEntryAbstract
     */
    protected $object;

    /**
     * __construct
     *
     * @param string $alias
     * @param string $property
     * @param string $type
     */
    protected function __construct(
        $alias,
        $property,
        $type = null
    ) {
        $this->setAlias($alias);
        $this->setProperty($property);
        $this->setType(!empty($type) ? $type : null);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
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
     * @return BehaviorEntryAbstract
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * @param BehaviorEntryAbstract $behavior
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @return FormatEntryAbstract[]
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param FormatEntryAbstract[] $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return ObjectEntryAbstract
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param ObjectEntryAbstract $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * toArray
     *
     * @param array $properties
     *
     * @return array
     */
    public function toArray($properties = null)
    {
        return empty($properties) ? $this->defaultToArray() : $this->customToArray($properties);
    }

    /**
     * @param $properties
     *
     * @return array
     */
    protected function customToArray($properties)
    {
        $array = [];
        foreach ($properties as $property) {
            if (method_exists(
                $this,
                'get' . ucfirst($property)
            )) {
                $value = $this->{'get' . ucfirst($property)}();
                if (is_object($value)) {
                    $value = method_exists(
                        $value,
                        'toArray'
                    ) ? $value->toArray() : null;
                }
                $array[$property] = !empty($value) ? $value : 'not defined';
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    protected function defaultToArray()
    {
        $array = [];

        $array['alias'] = $this->getAlias();
        $array['property'] = $this->getProperty();

        if (!empty($this->getType())) {
            $array['type'] = $this->getType();
        }

        $array['behavior'] = $this->getBehavior()->toArray();

        if (!empty($this->getFormat())) {
            $format = [];
            foreach ($this->getFormat() as $item) {
                $format[] = $item->toArray();
            }
            $array['format'] = $format;
        }

        if (!empty($this->getObject())) {
            $array['object'] = $this->getObject()->toArray();
        }

        return $array;
    }
}
