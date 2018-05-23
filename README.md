[![Build Status](https://travis-ci.org/Facturama/facturama-php-sdk.svg?branch=master)](https://travis-ci.org/Facturama/facturama-php-sdk)

# Facturama SDK PHP

[NOTE] This document is also available in [Spanish]

This library requires PHP 5.5 as minimum

## How do I install it?

    composer require facturama/facturama-php-sdk:^2.0@dev

### Including the Lib

It includes the library to your project
```php
require __DIR__.'/vendor/autoload.php';
```

Start the development!

### Create an instance of Facturama\Client class

Example:
```php
$facturama = new \Facturama\Client('USER', 'PASSWORD');
```

With this client you can start working, at this step your are ready to make API
calls on behalf of the user.

## API operations

- Create, get, cancel CFDIs; download XMLs and PDFs and send them by email;
- Check profile and current subscription;
- Logo and digital certificates uploading;
- CRUDs for Product, Customer, Branch office and series.

*All operations will be reflected on Facturama's web app.*

## Mult-issuer API operations

- Create, get, cancel CFDIs; download XMLs and PDFs;
- CRUD for digital sign certificates ("CSD", "Certificados de los Sellos Digitales").

*These operations will not be reflected on Facturama's web app.*

With this client you can start to work, in this step you're ready to make API calls on behalf of the user.

## Examples
Don't forget to check out our examples codes in the  [examples] directory

## I want to contribute!
That is great! Just fork the project in GitHub, create a topic branch, write some code, and add some tests for your new code.

Thanks for helping!

## Contributing:
[phansys](https://github.com/phansys)

[Spanish]: ./README-es.md
[examples]: ./examples/
