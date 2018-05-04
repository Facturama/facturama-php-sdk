<?php


require __DIR__.'/../../../vendor/autoload.php';


printf('<pre>%s<pre>', var_export($result, true));

    public static function findByValue($value,)
    {
		$facturama = new Facturama\Client("pruebas", "pruebas2011");
		$params = [
		'keyword'=> ''.$value;
		];
		$result = $facturama->get('Catalogs/Units', $params);
		$x=$result["0"];
		$y=$x->Value;
		printf('<pre>%s<pre>', var_export($result, true));



        return $result;
    }