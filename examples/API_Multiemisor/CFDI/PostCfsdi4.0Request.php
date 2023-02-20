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

    "Serie"=>"A",
    "NameId"=> "1",
    "Folio"=> "999",
    "CfdiType"=> "I",
    "Currency"=> "MXN",
    "PaymentForm"=> "01",
    "PaymentMethod"=> "PUE",
    "Exportation"=> "01",
    "Date"=> null,
    "ExpeditionPlace"=> "78140",
    "OrderNumber"=> "TEST-001",
    "PaymentAccountNumber"=> "6789",
    "PaymentConditions"=> "Condiciones",
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
    "PaymentBankName"=> "BBVA"
];

$result = $facturama->post('api-lite/3/cfdis', $params);
printf('<pre>%s<pre>', var_export($result, true));
