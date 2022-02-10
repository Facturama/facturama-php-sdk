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

$clientId = 'TGpJ_Ko32_ZSEPBcZXRnRw2';

$result = $facturama->delete('Client/'.$clientId);
printf('<pre>%s<pre>', var_export($result, true));
