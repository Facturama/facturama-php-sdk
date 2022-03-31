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

$params = 
[
    'type'=>'issued',
    'folioStart'=>'100',
    'folioEnd'=>'200',
    'rfcissuer'=>'EKU9003173C9',
    'rfc'=>'XAXX',
    'taxEntityName'=>'Publico',
    'status'=>'active',
];


$result = $facturama->get('api-lite/cfdis/',$params);

printf('<pre>%s<pre>', var_export($result, true));