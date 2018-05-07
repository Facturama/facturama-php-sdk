<?php

	require __DIR__.'/../../../vendor/autoload.php';
		$facturama = new Facturama\Client("pruebas", "pruebas2011");
		$params = [
		'keyword'=> ''."18"
		];
		$result = $facturama->get('Catalogs/Units', $params);
		$x=$result["0"];
		$y=$x->Value;


return $y;