<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <soporte-api@facturama.mx>
 *
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require __DIR__.'/vendor/autoload.php';

$facturama = new Facturama\Client('pruebas', 'pruebas2011');
$params=
[
  "Currency"=> "MXN",
  "ExpeditionPlace"=> "78140",
  "PaymentConditions"=> "CREDITO A SIETE DIAS",
  "Folio"=> "100",
  "CfdiType"=> "I",
  "PaymentForm"=> "03",
  "PaymentMethod"=> "PUE",
  "Exportation"=>"01",
  "GlobalInformation"=>
  [ 
      "Periodicity"=>"04",
      "Months"=>"04",
      "Year"=>"2022"
  ],
  "Receiver"=> [
    "Rfc"=> "XAXX010101000",
    "Name"=> "PUBLICO EN GENERAL",
    "CfdiUse"=> "S01",
    "TaxZipCode"=> "78140",
    "FiscalRegime"=>"616"
  ],
  "Items"=> [
    [
      "ProductCode"=> "10101504",
      "IdentificationNumber"=> "EDL",
      "Description"=> "Estudios de laboratorio",
      "Unit"=> "NO APLICA",
      "UnitCode"=> "MTS",
      "UnitPrice"=> 50,
      "Quantity"=> 2.0,
      "Subtotal"=> 100,
      "TaxObject"=> "02",
      "Taxes"=> [
        [
          "Total"=> 16,
          "Name"=> "IVA",
          "Base"=> 100,
          "Rate"=> 0.16,
          "IsRetention"=> false
        ]
      ],
      "Total"=> 116
    
    ]
  ]
];
//CFDI 4.0 - Factura Global
$result = $facturama->post('3/cfdis', $params);

printf('<pre>%s<pre>', var_export($result, true));