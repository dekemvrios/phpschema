<?php

namespace Solis\Expressive\Schema\Operations;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Schema\Entries\Behavior\IntegerBehavior;

/**
 * Trait DatabaseFieldsOperations
 *
 * @package Solis\Expressive\Operations
 */
trait DatabaseFieldsOperations
{

    /**
     * @var PropertyContract[]
     */
    private $persistentFields = [];

    /**
     * @var PropertyContract[]|string
     */
    private $searchableFieldsMeta = [];

    /**
     * @var array
     */
    private $searchableFieldsString;

    /**
     * @var PropertyContract[]
     */
    private $incrementalFieldsMeta;

    /**
     * @var array
     */
    private $incrementalFieldsString;

    /**
     * @var PropertyContract[]
     */
    private $databaseIncrementalFieldsMeta;

    /**
     * @var array
     */
    private $databaseIncrementalFieldsString;

    /**
     * @var PropertyContract[]
     */
    private $applicationIncrementalFieldsMeta;

    /**
     * @var array
     */
    private $applicationIncrementalFieldsString;


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
                $persistentFields = array_filter(
                    $persistentFields,
                    function (PropertyContract $property) {
                        if (!$property->getBehavior()->isPersistent()) {
                            return false;
                        }

                        if (!$property->getBehavior() instanceof IntegerBehavior) {
                            return true;
                        }

                        if ($property->getBehavior()->getIncrementalBehavior() == 'database') {
                            return false;
                        }

                        return true;
                    }
                );
            }
            $this->persistentFields = $persistentFields;
        }

        return $this->persistentFields;
    }

    /**
     * getIncrementalFieldsMeta
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento
     *
     * @return PropertyContract[]|boolean
     */
    public function getIncrementalFieldsMeta()
    {
        if (!empty($this->incrementalFieldsMeta)) {
            return $this->incrementalFieldsMeta;
        }

        $incrementalFieldsMeta = $this->getPropertyContainer()->getFields('hasMany');
        if (!empty($incrementalFieldsMeta)) {
            $incrementalFieldsMeta = array_filter(
                $incrementalFieldsMeta,
                function (PropertyContract $property) {
                    if (!$property->getBehavior()->isPersistent()) {
                        return false;
                    }

                    if (!$property->getBehavior() instanceof IntegerBehavior) {
                        return false;
                    }

                    if (!empty($property->getBehavior()->isAutoIncrement())) {
                        return true;
                    }

                    return false;
                }
            );
        }
        $this->incrementalFieldsMeta = $incrementalFieldsMeta;

        return $this->incrementalFieldsMeta;
    }

    /**
     * getIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento
     *
     * @return array|boolean
     */
    public function getIncrementalFieldsString()
    {
        if (!empty($this->incrementalFieldsString)) {
            return $this->incrementalFieldsString;
        }

        $incrementalFieldsMeta = $this->getIncrementalFieldsMeta();
        if (empty($incrementalFieldsMeta)) {
            return false;
        }

        $this->incrementalFieldsString = array_map(function (PropertyContract $property) {
            return $property->getField();
        }, $incrementalFieldsMeta);

        return $this->incrementalFieldsString;
    }

    /**
     * getDatabaseIncrementalFieldsString
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento a partir do
     * database
     *
     * @return PropertyContract[]|boolean
     */
    public function getDatabaseIncrementalFieldsMeta()
    {
        if (!empty($this->databaseIncrementalFieldsMeta)) {
            return $this->databaseIncrementalFieldsMeta;
        }

        $databaseIncrementalFieldsMeta = $this->getPropertyContainer()->getFields('hasMany');
        if (!empty($databaseIncrementalFieldsMeta)) {
            $databaseIncrementalFieldsMeta = array_filter(
                $databaseIncrementalFieldsMeta,
                function (PropertyContract $property) {
                    if (!$property->getBehavior()->isPersistent()) {
                        return false;
                    }

                    if (!$property->getBehavior() instanceof IntegerBehavior) {
                        return false;
                    }

                    if ($property->getBehavior()->getIncrementalBehavior() !== 'database') {
                        return false;
                    }

                    return true;
                }
            );
        }
        $this->databaseIncrementalFieldsMeta = $databaseIncrementalFieldsMeta;

        return $this->databaseIncrementalFieldsMeta;
    }



    /**
     * getDatabaseIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento a partir do database
     *
     * @return array|boolean
     */
    public function getDatabaseIncrementalFieldsString()
    {
        if (!empty($this->databaseIncrementalFieldsString)) {
            return $this->databaseIncrementalFieldsString;
        }

        $databaseIncrementalFieldsMeta = $this->getDatabaseIncrementalFieldsMeta();
        if (empty($databaseIncrementalFieldsMeta)) {
            return false;
        }

        $this->databaseIncrementalFieldsString = array_map(function (PropertyContract $property) {
            return $property->getField();
        }, $databaseIncrementalFieldsMeta);

        return $this->databaseIncrementalFieldsString;
    }

    /**
     * getApplicationIncrementalFieldsMeta
     *
     * Retorna a relação de meta informação de propriedades vinculadas a persistencia com incremento a partir da
     * aplicação
     *
     * @return PropertyContract[]|boolean
     */
    public function getApplicationIncrementalFieldsMeta()
    {
        if (!empty($this->applicationIncrementalFieldsMeta)) {
            return $this->applicationIncrementalFieldsMeta;
        }

        $applicationIncrementalFieldsMeta = $this->getPropertyContainer()->getFields('hasMany');
        if (!empty($applicationIncrementalFieldsMeta)) {
            $applicationIncrementalFieldsMeta = array_filter(
                $applicationIncrementalFieldsMeta,
                function (PropertyContract $property) {
                    if (!$property->getBehavior()->isPersistent()) {
                        return false;
                    }

                    if (!$property->getBehavior() instanceof IntegerBehavior) {
                        return false;
                    }

                    if ($property->getBehavior()->getIncrementalBehavior() !== 'application') {
                        return false;
                    }

                    return true;
                }
            );
        }
        $this->applicationIncrementalFieldsMeta = $applicationIncrementalFieldsMeta;

        return $this->applicationIncrementalFieldsMeta;
    }

    /**
     * getApplicationIncrementalFieldsString
     *
     * Retorna a relação de propriedades vinculadas a persistencia com incremento a partir da aplicação
     *
     * @return array|boolean
     */
    public function getApplicationIncrementalFieldsString()
    {
        if (!empty($this->applicationIncrementalFieldsString)) {
            return $this->applicationIncrementalFieldsString;
        }

        $applicationIncrementalFieldsMeta = $this->getApplicationIncrementalFieldsMeta();
        if (empty($applicationIncrementalFieldsMeta)) {
            return false;
        }

        $this->applicationIncrementalFieldsString = array_map(function (PropertyContract $property) {
            return $property->getField();
        }, $applicationIncrementalFieldsMeta);

        return $this->applicationIncrementalFieldsString;
    }

    /**
     * getSearchableFieldsMeta
     *
     * Retorna a relação de propriades vinculadas a persistencia do registro habilitadas para consulta
     *
     * @return PropertyContract[]|boolean
     */
    public function getSearchableFieldsMeta()
    {
        if (!empty($this->searchableFieldsMeta)) {
            return $this->searchableFieldsMeta;
        }

        if ($searchableFieldsMeta = $this->getPropertyContainer()->getFields('hasMany')) {

            $searchableFieldsMeta = array_filter($searchableFieldsMeta, function (PropertyContract $property) {
                return $property->getBehavior()->isPersistent();
            });
        }
        $this->searchableFieldsMeta = $searchableFieldsMeta;

        return $this->searchableFieldsMeta;
    }

    /**
     * getSearchableFieldsString
     *
     * Retorna a relação de propriades vinculadas a persistencia do registro habilitadas para consulta
     *
     * @return array|boolean
     */
    public function getSearchableFieldsString()
    {
        if (!empty($this->searchableFieldsString)) {
            return $this->searchableFieldsString;
        }

        $searchableFieldsMeta = $this->getSearchableFieldsMeta();
        if (empty($searchableFieldsMeta)) {
            return false;
        }

        $this->searchableFieldsString = array_map(function (PropertyContract $property) {
            return $property->getField();
        }, $searchableFieldsMeta);

        return $this->searchableFieldsString;
    }
}