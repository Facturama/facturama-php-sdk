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

$format = 'pdf';  //Formato del archivo a obtener(pdf,Xml,html)
$type = 'issuedLite'; // Tipo de comprobante 
$id = 'OwMgofF7ZDEM60gerUXudw2'; // Identificador unico de la factura
$params = [];

$result = $facturama->get('cfdi/'.$format.'/'.$type.'/'.$id, $params);
$myfile = fopen('factura'.$id.'.'.$format, 'a+');

fwrite($myfile, base64_decode(end($result)));
fclose($myfile);
printf('<pre>%s<pre>', var_export(true));