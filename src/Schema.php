<?php

namespace Solis\Expressive\Schema;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ContainerContract as DatabaseContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
use Solis\Expressive\Schema\Entries\Behavior\IntegerBehavior;
use Solis\Expressive\Schema\Containers\DatabaseContainer;
use Solis\Expressive\Schema\Containers\PropertyCotainer;
use Solis\Expressive\Schema\Contracts\SchemaContract;

/**
 * Class Schema
 *
 * @package Solis\Expressive\Schema
 */
class Schema implements SchemaContract
{
    /**
     * @var PropertyContainerContract
     */
    private $propertyContainer;

    /**
     * @var DatabaseContainerContract
     */
    private $databaseContainer;

    /**
     * @var PropertyContract[]
     */
    private $persistentFields = [];

    /**
     * Schema constructor.
     *
     * @param PropertyContainerContract $propertyContainer
     */
    protected function __construct(
        $propertyContainer
    ) {
        $this->serPropertyContainer($propertyContainer);
    }

    /**
     * make
     *
     * @param string $json
     *
     * @return SchemaContract
     * @throws SchemaException
     */
    public static function make($json)
    {
        $schema = json_decode(
            $json,
            true
        );
        if (!$schema) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "Error decoding json file while creating schema",
                500
            );
        }

        if (!array_key_exists(
            'properties',
            $schema
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'properties' field has not been found for defining schema entry",
                500
            );
        }


        $instance = new self(
            PropertyCotainer::make(
                $schema['properties']
            )
        );

        if (array_key_exists(
            'database',
            $schema
        )
        ) {
            $instance->setDatabaseContainer(
                DatabaseContainer::make(
                    $schema['database'],
                    $instance->getPropertyContainer()
                )
            );
        }

        return $instance;
    }

    /**
     * setPropertyContainer
     *
     * Atribui o container contendo operações e especificações de propriedades
     *
     * @param PropertyContainerContract $propertyContainer
     */
    public function serPropertyContainer($propertyContainer)
    {
        $this->propertyContainer = $propertyContainer;
    }

    /**
     * getPropertyContainer
     *
     * Retorna o container contendo operações e especificações de propriedades
     *
     * @return PropertyContainerContract
     */
    public function getPropertyContainer()
    {
        return $this->propertyContainer;
    }

    /**
     * setDatabaseContainer
     *
     * Atribui o container contendo operações e especificações de database
     *
     * @param DatabaseContainerContract $databaseContainer
     */
    public function setDatabaseContainer($databaseContainer)
    {
        $this->databaseContainer = $databaseContainer;
    }

    /**
     * getDatabaseContainer
     *
     * Retorna o container contendo operações e especificações de database
     *
     * @return DatabaseContainerContract
     */
    public function getDatabaseContainer()
    {
        return $this->databaseContainer;
    }

    /**
     * getRepository
     *
     * Retorna o nome do repositorio utilizado para persistir o registro
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->getDatabaseContainer()->getDatabase()->getRepository();
    }

    /**
     * getProperties
     *
     * Retorna a relação de propriedades do active record
     *
     * @return PropertyContract[]
     */
    public function getProperties()
    {
        return $this->getPropertyContainer()->getProperties();
    }

    /**
     * getDependencies
     *
     * Retorna a relação de propriedades especificadas como dependências do active record
     *
     * @param  string $type tipo de dependencia a ser retornada
     *
     * @return PropertyContract[]|boolean
     */
    public function getDependencies($type = null)
    {
        if (!empty($type)) {
            return $this->getDatabaseContainer()->getDatabase()->getDependencies()->{'get' . $type}();
        }

        $array = [];

        $hasOne = $this->getDatabaseContainer()->getDatabase()->getDependencies()->getHasOne();
        if (!empty($hasOne)) {
            $array = array_merge(
                $array,
                array_values($hasOne)
            );
        }

        $hasMany = $this->getDatabaseContainer()->getDatabase()->getDependencies()->getHasMany();
        if (!empty($hasMany)) {
            $array = array_merge(
                $array,
                array_values($hasMany)
            );
        }

        return !empty($array) ? $array : false;
    }

    /**
     * getKeys
     *
     * Retorna a relação de propriedades especificadas como chaves de identificação do active record
     *
     * @return PropertyContract[]
     */
    public function getKeys()
    {
        return $this->getDatabaseContainer()->getDatabase()->getKeys();
    }

    /**
     * getActions
     *
     * Retorna a relação de ações especificadas a serem executadas no contexto da persistência
     *
     * @return ActionContract
     */
    public function getActions()
    {
        return $this->getDatabaseContainer()->getDatabase()->getActions();
    }

    /**
     * getPersistentFields
     *
     * Retorna a relação de propriedades do active record com exceção dos do tipo de relacionamento hasMany
     *
     * @return PropertyContract[]
     */
    public function getPersistentFields()
    {
        if (empty($this->persistentFields)) {

            $persistentFields = $this->getPropertyContainer()->getFields('hasMany');
            if (!empty($persistentFields)) {
                $persistentFields = array_filter($persistentFields, function (PropertyContract $property) {
                    if (!$property->getBehavior() instanceof IntegerBehavior) {
                        return true;
                    }

                    if ($property->getBehavior()->getIncrementalBehavior() == 'database') {
                        return false;
                    }

                    return true;
                });
            }
            $this->persistentFields = $persistentFields;
        }

        return $this->persistentFields;
    }

    /**
     * getPropertyEntryByIdentifier
     *
     * Retornar o conjunto de especificações de determinada propriedade presente no schema de acordo com a relação de
     * valor a ser encontrado e a qual entrada do conjunto de propriedades pertence esse valor.
     *
     * @param mixed  $value      Valor a ser comparado com determinada entrada no conjunto de propriedades
     * @param string $identifier Propriede qual contem o valor a ser buscado
     *
     * @return PropertyContract|boolean
     */
    public function getPropertyEntryByIdentifier(
        $value,
        $identifier = 'property'
    ) {
        foreach ($this->getPropertyContainer()->getProperties() as $property) {
            if ($property->{'get' . $identifier}() == $value) {
                return $property;
            }
        }

        return false;
    }

    /**
     * toArray
     *
     * Retorna uma representação em formato de array associativo do schema
     *
     * @param array $properties
     *
     * @return array
     */
    public function toArray($properties = null)
    {
        $array = [];
        if (!empty($this->getPropertyContainer())) {
            $array['properties'] = [];

            foreach ($this->getPropertyContainer()->getProperties() as $item) {
                if (method_exists(
                    $item,
                    'toArray'
                )) {
                    $array['properties'][] = $item->toArray();
                }
            }
        }
        if (!empty($this->getDatabaseContainer())) {
            $array['database'] = $this->getDatabaseContainer()->getDatabase()->toArray();
        }

        return $array;
    }

    /**
     * toJson
     *
     * Retorna uma representação em formato json do schema
     *
     * @return string
     */
    public function toJson()
    {
        $json = null;
        if (!empty($this->toArray())) {
            $json = json_encode($this->toArray());
        }

        return $json;
    }
}
