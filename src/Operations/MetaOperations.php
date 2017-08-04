<?php

namespace Solis\Expressive\Schema\Operations;

/**
 * Trait MetaOperations
 *
 * @package Solis\Expressive\Operations
 */
trait MetaOperations
{

    /**
     * @var array
     */
    private $meta;

    /**
     * getMeta
     *
     * Retorna a relação meta informação atribuida ao schema
     *
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * setMeta
     *
     * Atribui a relação de meta informação sobre o schema
     *
     * @param mixed $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }
}