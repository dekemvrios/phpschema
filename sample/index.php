<?php

require_once '../vendor/autoload.php';

use Solis\PhpSchema\Sample\Classes\Estado;
use Solis\Breaker\TException;

try {

    $instance = new Estado();

    echo $instance->schema->toJson();
} catch (TException $exception) {
    echo $exception->toJson();
}