<?php

namespace Solis\Expressive\Schema\Entries\Database;

use Solis\Expressive\Schema\Contracts\Entries\Database\DependenciesContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\ContainerContract as PropertyContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\DatabaseContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\SchemaException;

/**
 * Class Database
 *
 * @package Solis\Expressive\Schema\Entries\Database
 */
class Database implements DatabaseContract
{
    /**
     * @var string
     */
    private $repository;

    /**
     * @var PropertyContract[]
     */
    private $keys = [];

    /**
     * @var DependenciesContract
     */
    private $dependencies;

    /**
     * @var ActionContract
     */
    private $actions;

    /**
     * DatabaseEntryAbstract constructor.
     *
     * @param string             $table
     * @param PropertyContract[] $primaryKeys
     */
    protected function __construct(
        $table,
        $primaryKeys
    ) {
        $this->setRepository($table);
        $this->setKeys(!is_array($primaryKeys) ? [$primaryKeys] : $primaryKeys);
    }

    /**
     * make
     *
     * @param array                     $database
     * @param PropertyContainerContract $propertyContainer
     *
     * @throws SchemaException
     *
     * @return self
     */
    public static function make(
        $database,
        $propertyContainer
    ) {
        if (!array_key_exists(
            'repository',
            $database
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'repository' field has not been found for defining database schema entry ",
                400
            );
        }

        if (!array_key_exists(
            'keys',
            $database
        )
        ) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                "'keys' field has not been found for defining database schema entry ",
                400
            );
        }

        $metaKeys = $propertyContainer->getMeta($database['keys']);
        if (empty($metaKeys)) {
            throw new SchemaException(
                __CLASS__,
                __METHOD__,
                'properties used as primary keys hasn\'t been found at properties entry array',
                400
            );
        }

        $instance = new self(
            $database['repository'],
            $metaKeys
        );

        $metaHasOneDependencies = $propertyContainer->getMetaForRelationshipType('hasOne');
        $metaHasManyDependencies = $propertyContainer->getMetaForRelationshipType('hasMany');
        if (!empty($metaHasOneDependencies) || !empty($metaHasManyDependencies)) {
            $dependency = new Dependencies();
            if (!empty($metaHasManyDependencies)) {
                $dependency->setHasMany(array_values($metaHasManyDependencies));
            }
            if (!empty($metaHasOneDependencies)) {
                $dependency->setHasOne(array_values($metaHasOneDependencies));
            }
            $instance->setDependencies($dependency);
        }

        if (array_key_exists(
            'actions',
            $database
        )) {
            $instance->setActions(Action::make($database['actions']));
        }

        return $instance;
    }

    /**
     * setRepository
     *
     * Atribui Nome da fonte qual está contido os dados do active record a ser manipulado
     *
     * @param string $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * getRepository
     *
     * Nome da fonte qual está contido os dados do active record a ser manipulado
     *
     * @return string
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * setKeys
     *
     * Atribui Relação de chaves utilizadas como identificador do registro na persistência
     *
     * @param PropertyContract[] $keys
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
    }

    /**
     * getKeys
     *
     * Relação de chaves utilizadas como identificador do registro na persistência
     *
     * @return PropertyContract[]
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * setActions
     *
     * @param ActionContract $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * getActions
     *
     * Relação de acoes utilizadas no contexto das operações de persistencia do registro
     *
     * @return ActionContract
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * setDependencies
     *
     * Atribui Relação de dependencias atribuidas ao registro
     *
     * @param DependenciesContract $dependencies
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * getDependencies
     *
     * Relação de dependencias atribuidas ao registro
     *
     * @return DependenciesContract
     */
    public function getDependencies()
    {
        return $this->dependencies;
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
        $array = [];

        $array['repository'] = $this->getRepository();

        $array['keys'] = [];
        foreach ($this->getKeys() as $primaryKey) {
            $array['keys'][] = $primaryKey->toArray();
        }

        if (!empty($this->getDependencies())) {
            $array['dependencies'] = $this->getDependencies()->toArray();
        }

        if (!empty($this->getActions())) {
            $array['actions'] = $this->getActions()->toArray();
        }

        return $array;
    }
}
