# README

## PhpSchema

PhpSchema é utilizado como ferramenta por [phpexpressive](https://github.com/rafaelbeecker/phpexpressive) para especificação das definições de objetos active record.

## Como instalar?

Esse pacote foi estruturado para ser instalado por meio do composer

```
composer require solis/phpschema
``` 

## Como utilizar?

Fornecer uma string representando as definições do objeto para o método construtor stático da classe Schema
 
```
$schema = Schema::make(
     file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")
);
 ```

A string será validada e retornará um objeto válido em caso de sucesso. Qualquer valor inválido irá disparar uma instancia SchemaException
qual implementa a interface TExceptionContract


## Change log

Acompanhe o [CHANGELOG](CHANGELOG.md) para informações sobre atualizações recentes.

## Testes

```
$ composer test
```

## Licença

The MIT License (MIT). Verifique [LICENSE](LICENSE.MD) para mais informações.