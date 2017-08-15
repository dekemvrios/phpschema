<?php

namespace Solis\Expressive\Schema\Entries;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;
use Solis\Expressive\Schema\Contracts\Entries\Composition\CompositionContract;
use Solis\Expressive\Schema\Contracts\Entries\DynamicFunction\DynamicFunctionContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Entries\Composition\Composition;
use Solis\Expressive\Schema\Entries\Behavior\Behavior;
use Solis\Expressive\Schema\SchemaException;

/**
 * Class Property
 *
 * @package Solis\Expressive\Schema\Entries
 */
class Property implements PropertyContract
{

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $property;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var DynamicFunctionContract[]
     */
    private $format;

    /**
     * @var CompositionContract
     */
    private $composition;

    /**
     * @var GenericContract
     */
    private $behavior;

    /**
     * @var array
     */
    private $allowedValues = [];

    /**
     * @var mixed
     */
    private $default;

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
     * make
     *
     * @param array $dados
     *
     * @return static
     * @throws SchemaException
     */
    public static function make($dados)
    {
        if (!array_key_exists(
            'property',
            $dados
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'property' field has not been found for defining schema entry",
                400
            );
        }

        if (!array_key_exists(
            'alias',
            $dados
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'alias' field has not been found for defining schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'type',
            $dados
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'type' field has not been found for defining schema entry ",
                400
            );
        }

        $instance = new self(
            $dados['alias'],
            $dados['property'],
            $dados['type']
        );

        if (array_key_exists(
            'format',
            $dados
        )) {
            $format = [];
            foreach ($dados['format'] as $item) {
                $format[] = DinamycFunction::make($item);
            }
            $instance->setFormat($format);
        }

        if (array_key_exists(
            'description',
            $dados
        )) {
            $instance->setDescription($dados['description']);
        }

        if (array_key_exists(
            'default',
            $dados
        )) {
            $instance->setDefault($dados['default']);
        }

        if (array_key_exists(
            'composition',
            $dados
        )) {
            $instance->setComposition(Composition::make($dados['composition']));
        }

        if (array_key_exists(
            'allowedValues',
            $dados
        )) {
            $allowedValues = !is_array($dados['allowedValues']) ? [$dados['allowedValues']] : $dados['allowedValues'];
            foreach ($allowedValues as $allowedValue) {
                if (!is_null($allowedValue)) {
                    $instance->addIntoAllowedValues($allowedValue);
                }
            }
        }

        $instance->setField(
            array_key_exists(
                'field',
                $dados
            ) ? $dados['field'] : $dados['property']
        );

        $instance->setBehavior(Behavior::make($dados));

        return $instance;
    }

    /**
     * setAlias
     *
     * Atribui o identificador de índice de array de dados fornecido como argumento para método attach para instanciar
     * model
     *
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * getAlias
     *
     * Identificador de índice de array de dados fornecido como argumento para método attach para instanciar model
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * setProperty
     *
     * Atribui o nome da propriedade presente na classe a ser instanciada
     *
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * getProperty
     *
     * Nome da propriedade presente na classe a ser instanciada
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * setField
     *
     * Nome do campo na persistência qual reflete a propriedade na respectiva classe
     *
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * getField
     *
     * Nome do campo na persistência qual reflete a propriedade na respectiva classe
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * setType
     *
     * Atribui o yipo de dado da propriedade
     *
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * getType
     *
     * Tipo de dado da propriedade
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * setFormat
     *
     * Atribui a Relação de estruturas de formatação utilizadas para tratar o dado da propriedade antes de ser atribuída
     *
     * @param DynamicFunctionContract[] $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * getFormat
     *
     * Relação de estruturas de formatação utilizadas para tratar o dado da propriedade antes de ser atribuída
     *
     * @return DynamicFunctionContract[]
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * setComposition
     *
     * Atribui as definições de relacionamento quando a propriedade for do tipo composição
     *
     * @param CompositionContract $composition
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;
    }

    /**
     * getComposition
     *
     * Retorna as definições de relacionamento quando a propriedade for do tipo composição
     *
     * @return CompositionContract
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * setBehavior
     *
     * Atribui as especificações do comportamento da propriedade do registro
     *
     * @param GenericContract $behavior
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * getBehavior
     *
     * Retorna as especificações do comportamento da propriedade do registro
     *
     * @return GenericContract
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * getDescription
     *
     * Retorna a descrição do campo atribuido ao schema
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * setDescription
     *
     * Atribui valor referente a descrição do campo no schema
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getAllowedValues()
    {
        return $this->allowedValues;
    }

    /**
     * @param array $allowedValues
     */
    public function setAllowedValues($allowedValues)
    {
        $this->allowedValues = $allowedValues;
    }

    /**
     * Retorna o valor default a ser atribuido a propriedade especificada no schema
     *
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Atribui o valor default a ser atribuido a propriedade especificada no schema
     *
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * Adiciona um valor a relação de valores válidos de acordo com o tipo
     * atribuido a respectiva entrada de schema
     *
     * @param $value
     *
     * @return boolean
     */
    private function addIntoAllowedValues($value)
    {
        if (empty($this->getType())) {
            return false;
        }

        if (in_array(
            $value,
            $this->allowedValues
        )) {
            return false;
        }

        switch ($this->getType()) {
            case 'int' :
                $value = intval($value);

                $this->allowedValues[] = $value;

                return true;

            case 'float' :
                $value = floatval($value);

                $this->allowedValues[] = $value;

                return true;
            case 'string' :
                $value = (string)$value;

                $this->allowedValues[] = $value;

                return true;
            default:

                return false;
        }
    }

    /**
     * toArray
     *
     * Retorna uma repsentação em array do schema
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];

        $array['alias'] = $this->getAlias();
        $array['property'] = $this->getProperty();
        $array['field'] = $this->getField();

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

        if (!empty($this->getAllowedValues())) {
            $array['allowedValues'] = $this->getAllowedValues();
        }

        if (!empty($this->getComposition())) {
            $array['composition'] = $this->getComposition()->toArray();
        }

        if (!empty($this->getDefault())) {
            $array['default'] = $this->getDefault();
        }

        return $array;
    }
}
