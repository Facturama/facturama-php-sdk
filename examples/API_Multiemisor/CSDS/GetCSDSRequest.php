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

$params = [];

$result = $facturama->get('api-lite/csds', $params );
printf('<pre>%s<pre>', var_export($result, true));