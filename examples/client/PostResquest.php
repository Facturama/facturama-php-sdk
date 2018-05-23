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

$params = [
  'Address' => [
    'Street' => 'St One ',
    'ExteriorNumber' => '15',
    'InteriorNumber' => '12',
    'Neighborhood' => 'Lower Manhattan, ',
    'ZipCode' => 'sample string 5',
    'Locality' => 'sample string 6',
    'Municipality' => 'sample string 7',
    'State' => 'sample string 8',
    'Country' => 'MX',
  ],
  'Rfc' => 'XEXX010101000',
  'Name' => 'Test Test',
  'Email' => 'test@facturma.com',
];
$result = $facturama->post('Client', $params);

printf('<pre>%s<pre>', var_export($result, true));
