<?php

namespace Solis\Expressive\Schema\Contracts;

use Solis\Expressive\Schema\Contracts\Entries\Database\ActionContract;
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
     * getActions
     *
     * Retorna a relação de ações especificadas a serem executadas no contexto da persistência
     *
     * @return ActionContract
     */
    public function getActions();

    /**
     * setMeta
     *
     * Atribui a relação de meta informação sobre o schema
     *
     * @param mixed $meta
     */
    public function setMeta($meta);

    /**
     * getMeta
     *
     * Retorna a relação meta informação atribuida ao schema
     *
     * @return mixed
     */
    public function getMeta();

    /**
     * getPersistentFields
     *
     * Retorna a relação de propriedades do active record com exceção dos do tipo de relacionamento hasMany
     *
     * @return PropertyContract[]
     */
    public function getPersistentFields();

    /**
     * getSearchableFieldsMeta
     *
     * Retorna a relação de propriades vinculadas a persistencia do registro habilitadas para consulta
     *
     * @return PropertyContract[]|boolean
     */
    public function getSearchableFieldsMeta();

    /**
     * getSearchableFieldsString
     *
     * Retorna a relação de propriades vinculadas a persistencia do registro habilitadas para consulta
     *
     * @return string|boolean
     */
    public function getSearchableFieldsString();

    /**
     * getIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento
     *
     * @return array|boolean
     */
    public function getIncrementalFieldsString();

    /**
     * getIncrementalFieldsMeta
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento
     *
     * @return PropertyContract[]|boolean
     */
    public function getIncrementalFieldsMeta();

    /**
     * getDatabaseIncrementalFieldsString
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento a partir do
     * database
     *
     * @return PropertyContract[]|boolean
     */
    public function getDatabaseIncrementalFieldsMeta();

    /**
     * getDatabaseIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento a partir do database
     *
     * @return array|boolean
     */
    public function getDatabaseIncrementalFieldsString();

    /**
     * getApplicationIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento a partir da aplicação
     *
     * @return array|boolean
     */
    public function getApplicationIncrementalFieldsString();

    /**
     * getApplicationIncrementalFieldsMeta
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento a partir da
     * aplicação
     *
     * @return PropertyContract[]|boolean
     */
    public function getApplicationIncrementalFieldsMeta();

    /**
     * getPropertyEntryByIdentifier
     *
     * Retornar o conjunto de especificações de determinada propriedade presente no schema de acordo com a relação de
     * valor a ser encontrado e a qual entrada do conjunto de propriedades pertence esse valor.
     *
     * @param mixed  $value      Valor a ser comparado com determinada entrada no conjunto de propriedades
     * @param string $identifier Propriede qual contem o valor a ser buscado
     *
     * @return mixed
     */
    public function getPropertyEntryByIdentifier(
        $value,
        $identifier = 'property'
    );

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
