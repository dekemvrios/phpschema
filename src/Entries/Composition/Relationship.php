<?php

namespace Solis\Expressive\Schema\Entries\Composition;

use Solis\Expressive\Schema\Contracts\Entries\Composition\RelationshipContract;
use Solis\Expressive\Schema\Contracts\Entries\Composition\SourceContract;
use Solis\Expressive\Schema\SchemaException;

/**
 * Class Relationship
 *
 * @package Solis\Expressive\Schema\Entries\Composition
 */
class Relationship implements RelationshipContract
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var SourceContract
     */
    private $source;

    /**
     * @var string|array
     */
    private $sharedFields;

    /**
     * RelationshipEntryAbstract constructor.
     *
     * @param string         $type
     * @param SourceContract $source
     */
    protected function __construct(
        $type,
        $source
    ) {
        $this->setType($type);
        $this->setSource($source);
    }

    /**
     * @param array $dados
     *
     * @return static
     *
     * @throws SchemaException
     */
    public static function make($dados)
    {
        if (!array_key_exists(
            'type',
            $dados
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "schema entry 'type' has not been found to set relationship schema",
                400
            );
        }

        if (!array_key_exists(
            'source',
            $dados
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "schema entry 'source' has not been found to set relationship schema",
                400
            );
        }

        $instance = new static(
            $dados['type'],
            Source::make($dados['source'])
        );

        if (array_key_exists(
            'sharedFields',
            $dados
        )) {
            $instance->setSharedFields(
                !is_array($dados['sharedFields']) ? [$dados['sharedFields']] : $dados['sharedFields']
            );
        }

        return $instance;
    }

    /**
     * setType
     *
     * Atribui o tipo de relacionamento qual existe entre o active record e composição
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * getType
     *
     * Retorna o tipo de relacionamento qual existe entre o active record e composição
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * setSource
     *
     * Atribui os campos que fazem parte do relacionamento entre active record e composição
     *
     * @param SourceContract $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * getSource
     *
     * Retorna os campos que fazem parte do relacionamento entre active record e composição
     *
     * @return SourceContract
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * setSharedFields
     *
     * Atribui relação de campos compartilhados entre active record composição
     *
     * @param string|array $sharedFields
     */
    public function setSharedFields($sharedFields)
    {
        $this->sharedFields = $sharedFields;
    }

    /**
     * getSharedFields
     *
     * Retorna relação de campos compartilhados entre active record composição
     *
     * @return string|array
     */
    public function getSharedFields()
    {
        return $this->sharedFields;
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
            "type"   => $this->getType(),
            "source" => $this->getSource()->toArray(),
        ];

        if (!empty($this->getSharedFields())) {
            $array['sharedFields'] = $this->getSharedFields();
        }

        return $array;
    }
}
