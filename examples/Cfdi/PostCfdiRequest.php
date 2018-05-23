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
    'ExpeditionPlace' => '12345',
    //'serie' => '',
    'Folio' => '100',
    'Currency' => 'MXN',
    'PaymentConditions' => 'CREDITO A SIETE DIAS',
    'CfdiType' => 'I',
    'PaymentForm' => '03',
    'PaymentMethod' => 'PUE',
    'Receiver' => [
           'Rfc' => 'XAXX010101000',
           'Name' => 'RADIAL SOFTWARE SOLUTIONS',
           'CfdiUse' => 'P01',
         ],
    'Items' => [
       [
            'ProductCode' => '10101504',
            'IdentificationNumber' => 'EDL',
            'Description' => 'Estudios de viabilidad',
            'Unit' => 'NO APLICA',
            'UnitCode' => 'MTS',
            'UnitPrice' => 50.0,
            'Quantity' => 2.0,
            'Subtotal' => 100.0,

            'Taxes' => [
               [
                   'Total' => 16.0,
                   'Name' => 'IVA',
                   'Base' => 100.0,
                   'Rate' => 0.16,
                   'IsRetention' => false,
               ],
            ],
            'Total' => 116.0,
        ],
    ],
];

$result = $facturama->post('2/cfdis', $params);

printf('<pre>%s<pre>', var_export($result, true));
