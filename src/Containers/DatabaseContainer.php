<?php

namespace Solis\Expressive\Schema\Containers;

use Solis\Expressive\Schema\Contracts\Entries\Database\ContainerContract as DatabaseContainerContract;
use Solis\Expressive\Schema\Contracts\Entries\Database\DatabaseContract;
use Solis\Expressive\Schema\Entries\Database\Database;
use Solis\Breaker\TException;

/**
 * Class DatabaseContainer
 *
 * @package Solis\Expressive\Schema\Containers
 */
class DatabaseContainer implements DatabaseContainerContract
{
    /**
     * @var DatabaseContract
     */
    private $database;

    /**
     * make
     *
     * @param array $database
     *
     * @return static
     * @throws TException
     */
    public static function make($database)
    {
        $instance = new self();
        $instance->setDatabase(
            Database::make($database)
        );

        return $instance;
    }

    /**
     * setDatabase
     *
     * Atribui as especificações do database do active record
     *
     * @param DatabaseContract $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * getProperties
     *
     * Retorna as especificações do database do active record
     *
     * @return DatabaseContract
     */
    public function getDatabase()
    {
        return $this->database;
    }
}