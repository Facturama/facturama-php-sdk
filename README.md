
[![Build Status](https://travis-ci.org/Facturama/facturama-php-sdk.svg?branch=master)](https://travis-ci.org/Facturama/facturama-php-sdk)

# Facturama PHP SDK 

>[NOTE] This document is also available in [English]
>
>Librería para consumir la API Web y API Multiemisor de [Facturama](https://api.facturama.mx/).
>
>Puedes consultar la guía completa de la [API](https://apisandbox.facturama.mx/guias).

## Crear cuenta de usuario

> Crear una cuenta de usuario en el ambiente de prueba [Sandbox](https://dev.facturama.mx/api/login) 
>
> Para API Web, realiza la configuración básica usando RFC de pruebas **"EKU9003173C9"**, más información [aquí](https://apisandbox.facturama.mx/guias/perfil-fiscal).
>
> Sellos Digitales de prueba (CSD), [aquí](https://apisandbox.facturama.mx/guias/conocimientos/sellos-digitales-pruebas). 

## Inicio Rápido

### Dependencias

Esta librería requiere PHP 5.5 como mínimo

### Instalación

```sh
    composer require facturama/facturama-php-sdk:^2.0@dev
```

### Incluyendo la librería

Incluye la librería a tu proyecto
```php
require __DIR__.'/vendor/autoload.php';
```
### Crear una instancia de la clase Facturama\Client
Ejemplo:
```php
$facturama = new \Facturama\Client('USER', 'PASSWORD');
```
## API Web

> Creación de CFDIs con un único emisor, (el propietario de la cuenta, cuyo Perfil Fiscal se tiene configurado)
> 
> *Todas las operaciones son reflejadas en la plataforma web.*

## Operaciones Web API

- Crear, Consultar y Cancelar CFDI así como descargar XML, PDF y envío de
  éstos por e-mail;
- Consultar Perfil y Suscripción actual;
- Carga de Logo y Certificados Digitales;
- CRUD de Productos, Clientes, Sucursales y Series.

Ejemplos: [aquí](https://github.com/Facturama/facturama-php-sdk/wiki/API-Web)


## API Multiemisor

> Creación de CFDIs con múltiples emisores.
>
> *Las operaciones NO se reflejan en la plataforma web.*

## Operaciones API Multiemisor

- Crear, Consultar, Cancelar descarga de XML
- CRUD de CSD (Certificados de los Sellos Digitales).

Ejemplos: [aquí](https://github.com/Facturama/facturama-php-sdk/wiki/API-Multiemisor)


## ¡Quiero contribuir!
¡Eso es genial! Simplemente raliza un fork del proyecto en GitHub, crea un branch, escribe un código y agrega algunas pruebas para tu nuevo código.

¡Gracias por ayudar!
## Contribuyendo:
[phansys](https://github.com/phansys)

[English]: ./README-en.md
[ejemplos]: ./examples/
