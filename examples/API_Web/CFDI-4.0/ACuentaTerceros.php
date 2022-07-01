<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <chucho@facturama.mx> <rafael@facturama.mx>
 *
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require __DIR__.'/vendor/autoload.php';

$facturama = new Facturama\Client('pruebas', 'pruebas2011');

$params = [
    'Serie' => 'A',
    'Folio' => '100',
    'Date' => null,
    'PaymentForm' => '01',
    'PaymentConditions' => 'CREDITO A SIETE DIAS',
    'Currency' => 'MXN',
    'CfdiType' => 'I',
    'PaymentMethod' => 'PUE',
    'ExpeditionPlace' => '78140',
    'Receiver' =>
    [
        'Rfc'=> 'URE180429TM6',
        'CfdiUse'=> 'G03',
        'Name'=> 'UNIVERSIDAD ROBOTICA ESPAÑOLA',
        'FiscalRegime'=> '603',
        'TaxZipCode' => '65000',
        'Address'=>
        [
            'Street' => 'Guadalcazar del receptor',
            'ExteriorNumber' => '300',
            'InteriorNumber' => 'A',
            'Neighborhood'=> 'Las lomas',
            'ZipCode' => '65000',
            'Municipality' => 'San Luis Potosi',
            'State' => 'San Luis Potosi',
            'Country' => 'México'
        ]
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
            'ThirdPartyAccount'=>
            [
                'Rfc'=>'CACX7605101P8',
                'Name'=>'XOCHILT CASAS CHAVEZ',
                'FiscalRegime'=>'616',
                'TaxZipCode'=>'10740'
            ],
            'PropertyTaxIDNumber'=>['123456789'],
            'TaxObject' => '02',
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
//CFDI 4.0 - Tipo Ingreso a cuenta de terceros
$result = $facturama->post('3/cfdis', $params);

printf('<pre>%s<pre>', var_export($result, true));