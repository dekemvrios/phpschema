# README

## What is PhpSchema
PhpSchema is a simple php schema object definition used in active record operations.

## How To Install?
This package was designed to be installed with composer dependency management tool.

```
composer require solis/phpschema
``` 

## How To Use it?
First, you need to define a schema, representing the properties and its expected properties. 

```
{
"database": {
    "table": "tbcidade"    
},
"properties": [
    {
      "alias": "sNome",
      "property": "nome",
      "type": "string"
    },
    {
      "alias": "iCodigoIbge",
      "property": "codigoIbge",
      "type": "int"
    }
  ]
}    
```

Require it with composer, instantiate a Schema class and using the json schema as argument

```
Solis\PhpSchema\Classes\Schema;

$schema = Schema::make(
    file_get_contents("/path/to/schema.json")
);
```
