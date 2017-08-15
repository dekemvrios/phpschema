<?php

require_once '../vendor/autoload.php';

use Solis\Expressive\Schema\Sample\Estado;
use Solis\Expressive\Schema\Sample\Cidade;
use Solis\Breaker\Abstractions\TExceptionAbstract;

try {

    $instance = new Cidade();

    //echo $instance->schema->toJson();

    var_dump($instance->schema->getIncrementalFieldsString());

} catch (TExceptionAbstract $exception) {
    echo $exception->toJson();
}