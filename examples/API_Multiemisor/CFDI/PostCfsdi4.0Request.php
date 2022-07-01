<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <chucho@facturama.mx> <rafael@facturama.mx>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require __DIR__.'/../../../vendor/autoload.php';

$facturama = new Facturama\Client('pruebas', 'pruebas2011');

$params = [
    "CfdiType"=> "I",
    "NameId"=> "1",
    "Folio"=> "100",
    "ExpeditionPlace"=> "78140",
    "PaymentForm"=> "01",
    "Date"=> null,
    "PaymentAccountNumber"=> "6789",
    "Currency"=> "MXN",
    "PaymentConditions"=> "Condiciones",
    "PaymentMethod"=> "PUE",
    "Issuer" =>
    [
        "Rfc"=> "URE180429TM6",
        "CfdiUse"=> "CP01",
        "Name"=> "UNIVERSIDAD ROBOTICA ESPAÑOLA",
        "FiscalRegime"=> "601",
        "TaxZipCode"=> "65000"
    ],
    "Receiver" =>
    [
        "Rfc"=> "OÑO120726RX3",
        "CfdiUse"=> "G03",
        "Name"=> "ORGANICOS ÑAVEZ OSORIO",
        "FiscalRegime"=> "601",
        "TaxZipCode" => "32040",
        "Address"=>
        [
            "Street" => "Guadalcazar del receptor",
            "ExteriorNumber" => "300",
            "InteriorNumber" => "A",
            "Neighborhood"=> "Las lomas",
            "ZipCode" => "32040",
            "Municipality" => "San Luis Potosi",
            "State" => "San Luis Potosi",
            "Country" => "México"
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
             "TaxObject" => "02",
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
    "LogoUrl"=> "https://www.ejemplos.co/wp-content/uploads/2015/11/Logo-Chanel.jpg",
    "Observations"=> "Este es un ejemplo de observaciones",
    "OrderNumber"=> "123321",
    "PaymentBankName"=> "BBVA"
];

$result = $facturama->post('api-lite/3/cfdis', $params);
printf('<pre>%s<pre>', var_export($result, true));
