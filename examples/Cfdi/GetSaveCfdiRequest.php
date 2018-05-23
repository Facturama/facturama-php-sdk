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
$document = 'html'; //variable que define el tipo de archivo a descargar(pdf,Xml,html)
$type = 'IssuedLite';
$id = 'OwMgofF7ZDEM60gerUXudw2';
$params = [];
$result = $facturama->get('cfdi/'.$document.'/'.$type.'/'.$id, $params);
$myfile = fopen('factura'.$id.'.'.$document, 'a+');
fwrite($myfile, base64_decode(end($result)));
fclose($myfile);
printf('<pre>%s<pre>', var_export(true));
