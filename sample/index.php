<?php

require_once '../vendor/autoload.php';

use Solis\Expressive\Schema\Sample\Estado;
use Solis\Breaker\Abstractions\TExceptionAbstract;

try {

    $instance = new Estado();

    //echo $instance->schema->toJson();

    var_dump($instance->schema->getDatabaseIncrementalFieldsMeta());

} catch (TExceptionAbstract $exception) {
    echo $exception->toJson();
}