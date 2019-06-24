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
	"Receiver"=> [
		"Name"=> "SERVICIOS ADMINISTRATIVOS AXKAN DEL BAJIO S.C",
		"CfdiUse"=> "P01",
		"Rfc"=> "XEXX010101000"
	],
	"CfdiType"=> "P",
	"NameId"=> "1",
	"Folio"=> "93",
	"ExpeditionPlace"=> "51873",
	"Complemento"=> [
		"Payments"=> [
			[
				"Date"=> "2018-10-04",
				"PaymentForm"=> "03",
				"Amount"=> "11142.21",
				"RelatedDocuments"=> [
					[
						"Uuid"=> "C94C8AF3-C774-4D4C-802E-781411934A6E",
						"Serie"=> "BQ",
						"Folio"=> "2205",
						"Currency"=> "USD",
						"ExchangeRate"=> "19.2107",
						"PaymentMethod"=> "PUE",
						"PartialityNumber"=> "1",
						"PreviousBalanceAmount"=> "1160.00",
						"AmountPaid"=> "580.00",
						"ImpSaldoInsoluto"=> "580.00"
					]
				]
			]
		]
	]
];
$params_api_lite=[
	"Issuer"=> [
		"FiscalRegime"=> "601",
		"Rfc"=> "AAA010101AAA",
		"Name"=> "EXPRESION EN SOFTWARE"
	],
	"Receiver"=> [
		"Name"=> "SERVICIOS ADMINISTRATIVOS AXKAN DEL BAJIO S.C",
		"CfdiUse"=> "P01",
		"Rfc"=> "SAA1609301X7"
	],
	"CfdiType"=> "P",
	"NameId"=> "1",
	"Folio"=> "93",
	"ExpeditionPlace"=> "76140",
	"Complemento"=> [
		"Payments"=> [
			[
				"Date"=> "2018-10-04",
				"PaymentForm"=> "03",
				"Amount"=> "11142.21",
				"RelatedDocuments"=> [
					[
						"Uuid"=> "C94C8AF3-C774-4D4C-802E-781411934A6E",
						"Serie"=> "BQ",
						"Folio"=> "2205",
						"Currency"=> "USD",
						"ExchangeRate"=> "19.2107",
						"PaymentMethod"=> "PUE",
						"PartialityNumber"=> "1",
						"PreviousBalanceAmount"=> "1160.00",
						"AmountPaid"=> "580.00",
						"ImpSaldoInsoluto"=> "580.00"
					]
				]
			]
		]
	]
];

/*
//cfdi complemento de pago
$result = $facturama->post('2/cfdis', $params);
*/

//cfdi complemento de pago Multiemisor
$result = $facturama->post('api-lite/2/cfdis', $params_api_lite);

printf('<pre>%s<pre>', var_export($result, true));
