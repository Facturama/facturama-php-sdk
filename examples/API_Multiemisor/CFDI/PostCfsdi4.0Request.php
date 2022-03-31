<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
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
    "ExpeditionPlace"=> "00000",
    "PaymentForm"=> "01",
    "Date"=> "2022-01-28 12:00:00",
    "PaymentAccountNumber"=> "6789",
    "Currency"=> "MXN",
    "PaymentConditions"=> "Condiciones",
    "PaymentMethod"=> "PUE",
    "Issuer" =>
    [
        "FiscalRegime" => "626",
        "Rfc" => "EKU9003173C9",
        "Name" => "Entidad Emisora"
    ],
    'Receiver' => 
    [
        'Rfc': 'URE180429TM6',
        'CfdiUse': 'G03',
        'Name': 'UNIVERSIDAD ROBOTICA ESPAÑOLA',
        'FiscalRegime': '601',
        'TaxZipCode' : '65000',
        'Address': 
        {
            'Street' : 'Guadalcazar del receptor',
            'ExteriorNumber' : '300',
            'InteriorNumber' : 'A',
            'Neighborhood': 'Las lomas',
            'ZipCode' : '65000',
            'Municipality' : 'San Luis Potosi',
            'State' : 'San Luis Potosi',
            'Country' : 'México'
        }
    ],
    "Items" =>
    [
        [
          "Quantity" => "100",
          "ProductCode" => "84111506",
          "UnitCode" => "E48",
          "Unit" => "Unidad de servicio",
          "Description" => " API folios adicionales",
          "IdentificationNumber" => "23",
          "UnitPrice" => "0.50",
          "Subtotal" => "50.00",
          "Discount" => "10",
          "DiscountVal" => "10",
          "Taxes" => 
            [
                [
                    "Name" => "IVA",
                    "Rate" => "0.16",
                    "Total" => "6.4",
                    "Base" => "40",
                    "IsRetention" => "false"
                ]
            ],
            "Total" => "46.40"
        ]
      ],
    "LogoUrl"=> "https://www.ejemplos.co/wp-content/uploads/2015/11/Logo-Chanel.jpg",
    "Observations"=> "Este es un ejemplo de observaciones",
    "OrderNumber"=> "123321",
    "PaymentBankName"=> "BBVA"
];

$result = $facturama->post('api-lite/2/cfdis', $params);
printf('<pre>%s<pre>', var_export($result, true));
