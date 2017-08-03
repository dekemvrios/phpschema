<?php

namespace Solis\Expressive\Schema\Contracts;

use Solis\Expressive\Schema\Contracts\Entries\Database\DependenciesContract;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;

/**
 * Interface SchemaContract
 *
 * @package Solis\Expressive\Schema\Contracts
 */
interface SchemaContract
{

    /**
     * getRepository
     *
     * Retorna o nome do repositorio utilizado para persistir o registro
     *
     * @return string
     */
    public function getRepository();

    /**
     * getProperties
     *
     * Retorna a relação de propriedades do active record
     *
     * @return PropertyContract[]
     */
    public function getProperties();

    /**
     * getDependencies
     *
     * Retorna a relação de propriedades especificadas como dependências do active record
     *
     * @param  string $type tipo de dependencia a ser retornada
     *
     * @return DependenciesContract|boolean
     */
    public function getDependencies($type = null);

    /**
     * getKeys
     *
     * Retorna a relação de propriedades especificadas como chaves de identificação do active record
     *
     * @return PropertyContract[]
     */
    public function getKeys();

    /**
     * getPersistentFields
     *
     * Retorna a relação de propriedades do active record com exceção dos do tipo de relacionamento hasMany
     *
     * @param bool $ignoreDatabaseIncrement indica se deverá retornar os valores incrementáveis pelo banco
     *
     * @return PropertyContract[]
     */
    public function getPersistentFields($ignoreDatabaseIncrement = false);

    /**
     * toArray
     *
     * Retorna uma representação em formato de array associativo do schema
     *
     * @return array
     */
    public function toArray();

    /**
     * toJson
     *
     * Retorna uma representação em formato json do schema
     *
     * @return string
     */
    public function toJson();
}
