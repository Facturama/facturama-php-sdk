[![Build Status](https://travis-ci.org/Facturama/facturama-php-sdk.svg?branch=master)](https://travis-ci.org/Facturama/facturama-php-sdk)

# Facturama SDK PHP

Esta librería requiere PHP 5.5 como mínimo

## Instalación de librería

    composer require facturama/facturama-php-sdk=dev-master

### Incluyendo la librería

Incluya la librería a su proyecto
```php
require __DIR__.'/vendor/autoload.php';
```

Comience el desarrollo!

## Operaciones Web API

- Crear, Consultar Cancelar CFDI así como descargar XML, PDF y envió de
   estos por mail.
- Consultar Perfil y Suscripción actual
- Carga de Logo y Certificados Digitales
- CRUD de Productos, Clientes, Sucursales y Series.

Algunos ejemplos: [aquí](https://github.com/Facturama/facturama-php-sdk/wiki/API-Web)

*Todas las operaciones son reflejadas en la plataforma web.*

## Operaciones API Multiemisor

- Crear, Consultar, Cancelar descarga de XML
- CRUD de CSD (Certificados de los Sellos Digitales).

Algunos ejemplos: [aquí](https://github.com/Facturama/facturama-php-sdk/wiki/API-Multiemisor)
*Las operaciones no se reflejan en la plataforma web.*

### Crear una instancia de la clase Facturama\Client
Ejemplo:
```php
$facturama = new \Facturama\Client('USER', 'PASSWORD');
```

Con este cliente puedes comenzar a trabajar, en este paso estás listo para hacer  llamadas a la API en nombre del usuario.
#### Hacer llamadas GET
```php
$params = [];
$result = $facturama->get('Client', $params);
```

#### Hacer llamadas POST
```php
$params = [
  "Address" => [
    "Street" => "St One ",
    "ExteriorNumber" => "15",
    "InteriorNumber" => "12",
    "Neighborhood" => "Lower Manhattan, ",
    "ZipCode" => "sample string 5",
    "Locality" => "sample string 6",
    "Municipality" => "sample string 7",
    "State" => "sample string 8",
    "Country" => "MX"
  ],
  "Rfc" => "XEXX010101000",
  "Name" => "Test Test",
  "Email" => "test@facturma.com"
];
$result = $facturama->post('Client', $params);
```

#### Hacer llamas PUT
```php
$clientId = 'TGpJ_Ko32_ZSEPBcZXRnRw2';
$body = [
  "Id" => $clientId,
  "Address" => [
    "Street" => "St One",
    "ExteriorNumber" => "15",
    "InteriorNumber" => "12",
    "Neighborhood" => "Lower Manhattan, ",
    "ZipCode" => "sample string 5",
    "Locality" => "sample string 6",
    "Municipality" => "sample string 7",
    "State" => "sample string 8",
    "Country" => "MX"
  ],
  "Rfc" => "XEXX010101000",
  "Name" => "Test Test 2",
  "Email" => "test@facturma.com"
];

$result = $facturama->put('Client/' . $clientId, $body);
```

#### Hacer llamadas DELETE
```php
$clientId = 'TGpJ_Ko32_ZSEPBcZXRnRw2';

$result = $facturama->delete('Client/' . $clientId);
```

## Examples
Don't forget to check out our examples codes in the [examples](https://github.com/facturama/facturama-php-sdk/tree/master/examples) directory

## I want to contribute!
That is great! Just fork the project in GitHub, create a topic branch, write some code, and add some tests for your new code.

Thanks for helping!

## Contributing:
[phansys](https://github.com/phansys)
