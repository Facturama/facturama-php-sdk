<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require __DIR__.'/../../vendor/autoload.php';

$facturama = new Facturama\Client('pruebas', 'pruebas2011');

$productId = 'NIUOt3Pgd24ErcrM1OFyag2';

$Product = [
      'Id' => $productId,
      'Taxes' => [
        [
      'Name' => 'IVA',
      'Rate' => '0.16',
      'IsRetention' => 'false',
       ], ],

  'Unit' => 'Servicio',
  'UnitCode' => 'E48',
  'IdentificationNumber' => 'WEB003',
  'Name' => 'Sitio Web CMS',
  'Description' => 'Desarrollo e implementación de sitio web empleando un CMS',
  'price' => '6500.00',
  'CodeProdServ' => '20102000',
  'CuentaPredial' => '123',
];

$result = $facturama->put('Product/'.$productId, $Product);

printf('<pre>%s<pre>', var_export($result, true));
