
[![Build Status](https://travis-ci.org/Facturama/facturama-php-sdk.svg?branch=master)](https://travis-ci.org/Facturama/facturama-php-sdk)

# Facturama SDK PHP

[NOTA] La versión original de este documento está disponible en [inglés]

Esta librería requiere PHP 5.5 como mínimo

## Instalación de librería

    composer require facturama/facturama-php-sdk:^2.0@dev

### Incluyendo la librería

Incluya la librería a su proyecto
```php
require __DIR__.'/vendor/autoload.php';
```
### Crear una instancia de la clase Facturama\Client
Ejemplo:
```php
$facturama = new \Facturama\Client('USER', 'PASSWORD');
```
¡Comience el desarrollo!

## Operaciones Web API

- Crear, Consultar Cancelar CFDI así como descargar XML, PDF y envío de
  estos por mail;
- Consultar Perfil y Suscripción actual;
- Carga de Logo y Certificados Digitales;
- CRUD de Productos, Clientes, Sucursales y Series.

*Todas las operaciones son reflejadas en la plataforma web.*

## Operaciones API Multiemisor

- Crear, Consultar, Cancelar descarga de XML
- CRUD de CSD (Certificados de los Sellos Digitales).

*Las operaciones no se reflejan en la plataforma web.*

Con este cliente puedes comenzar a trabajar, en este paso estás listo para hacer  llamadas a la API en nombre del usuario.


## Ejemplos
No olvide consultar nuestros ejemplos de códigos en el directorio de [ejemplos]

## ¡Quiero contribuir!
¡Eso es genial! Simplemente haga un fork del proyecto en GitHub, cree un branch tamático, escriba un código y agregue algunas pruebas para su nuevo código.

¡Gracias por ayudar!
## Contribuyendo:
[phansys](https://github.com/phansys)

[Inglés]: ./README.md
[ejemplos]: ./examples/
