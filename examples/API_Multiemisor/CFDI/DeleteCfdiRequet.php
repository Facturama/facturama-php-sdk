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

$CfdiId='9DLXTRINxFpHGLGEDWu23g2';

$params = 
[
    'motive'=>'02',
    'uuidReplacement'=>'null'
];

$result = $facturama->delete('api-lite/cfdis/'.$CfdiId, $params);
printf('<pre>%s<pre>', var_export($result, true));