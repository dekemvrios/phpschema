<?php

namespace Solis\Expressive\Schema\Entries\Composition;

use Solis\Expressive\Schema\Contracts\Entries\Composition\CompositionContract;
use Solis\Expressive\Schema\Contracts\Entries\Composition\RelationshipContract;
use Solis\Expressive\Schema\SchemaException;

/**
 * Class Composition
 *
 * @package Solis\Expressive\Schema\Entries\Composition
 */
class Composition implements CompositionContract
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var RelationshipContract
     */
    private $relationship;

    /**
     * __construct
     *
     * @param string $class
     */
    protected function __construct(
        $class
    ) {
        $this->setClass($class);
    }

    /**
     * make
     *
     * @param $class
     *
     * @return static
     * @throws SchemaException
     */
    public static function make($class)
    {
        if (!array_key_exists(
            'class',
            $class
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'class' field has not been found for defining 'object' schema entry",
                400
            );
        }

        if (!class_exists($class['class'])) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "class {$class['class']} has not been defined",
                400
            );
        }

        if (!method_exists(
            $class['class'],
            'make'
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "a 'class' defined in the 'object' schema entry must have a make method",
                400
            );
        }

        $instance = new static(
            $class['class']
        );

        if (array_key_exists(
            'relationship',
            $class
        )) {
            $instance->setRelationship(Relationship::make($class['relationship']));
        }

        return $instance;
    }

    /**
     * setClass
     *
     * Atribui o nome da classe a ser instânciada representando a composição
     *
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * getClass
     *
     * Nome da classe a ser instânciada representando a composição
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * setRelationship
     *
     * Atribui as especificações sobre o relacionamento entre o registro e a sua respectiva composição
     *
     * @param RelationshipContract $relationship
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
    }

    /**
     * getRelationship
     *
     * Especificações sobre o relacionamento entre o registro e a sua respectiva composição
     *
     * @return RelationshipContract
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * toArray
     *
     * Retorna representação em array do registro
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'class' => $this->getClass(),
        ];

        if (!empty($this->getRelationship())) {
            $array['relationship'] = $this->getRelationship()->toArray();
        }

        return $array;
    }
}
