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

$CfdiId = 'sniJoQdMCaa1c3M_7TLjIQ2';

$result = $facturama->get('api-lite/cfdis/'.$CfdiId);

printf('<pre>%s<pre>', var_export($result, true));
