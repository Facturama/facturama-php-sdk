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

$productId = 'NIUOt3Pgd24ErcrM1OFyag2';

$result = $facturama->delete('Product/'.$productId);
printf('<pre>%s<pre>', var_export($result, true));
