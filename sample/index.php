<?php

require_once '../vendor/autoload.php';

use Solis\Expressive\Schema\Sample\Estado;
use Solis\Expressive\Schema\Sample\Cidade;
use Solis\Breaker\Abstractions\TExceptionAbstract;

try {

    $instance = new Cidade();

    var_dump($instance->schema->getPropertiesWithDefaultValue());

} catch (TExceptionAbstract $exception) {
    echo $exception->toJson();
}