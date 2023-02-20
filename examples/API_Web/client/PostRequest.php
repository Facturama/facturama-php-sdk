<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <soporte-api@facturama.mx>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require __DIR__.'/../../../vendor/autoload.php';

$facturama = new Facturama\Client('pruebas', 'pruebas2011');

$params = [
    'Id'=>'',
    'Rfc' => 'CACX7605101P8',
    'Name' => 'XOCHILT CASAS CHAVEZ',
    'Email' => 'test@facturma.com',
    'FiscalRegime'=>'601',
    'CfdiUse'=>'G03',
    'TaxZipCode'=>'10740',
    'TaxResidence'=> '10740',
    'NumRegIdTrib'=> '131494-1055',
    'Address' => [
        'Street' => 'Calle de Pruebas',
        'ExteriorNumber' => '123',
        'InteriorNumber' => '456',
        'Neighborhood' => 'Colombia',
        'ZipCode' => '10740',
        'Locality' => 'Mexico',
        'Municipality' => 'Mexico Mun',
        'State' => 'Cd de Mexico',
        'Country' => 'MX',
  ],
];
$result = $facturama->post('Client', $params);

printf('<pre>%s<pre>', var_export($result, true));
