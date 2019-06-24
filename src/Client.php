<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Facturama;

use Facturama\Exception\ModelException;
use Facturama\Exception\RequestException;
use Facturama\Exception\ResponseException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use GuzzleHttp\RequestOptions;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class Client
{
    const VERSION = '2.0.0';
    /*
    https://apisandbox.facturama.mx //Pruebas desarrollo
    https://api.facturama.mx  //Produccion
    */
    const API_URL = 'https://apisandbox.facturama.mx/';
    const USER_AGENT = 'Facturama-PHP-SDK-v2.0.0';

    const FILE_TYPE_PDF = 'pdf';
    const FILE_TYPE_HTML = 'html';
    const FILE_TYPE_XML = 'xml';

    const RECEIPT_PAYROLL = 'payroll';
    const RECEIPT_RECEIVED = 'received';
    const RECEIPT_ISSUED = 'issued';

    const STATE_AGUASCALIENTES = 'AGUASCALIENTES';
    const STATE_BAJA_CALIFORNIA = 'BAJA CALIFORNIA';
    const STATE_BAJA_CALIFORNIA_SUR = 'BAJA CALIFORNIA SUR';
    const STATE_CAMPECHE = 'CAMPECHE';
    const STATE_CHIAPAS = 'CHIAPAS';
    const STATE_CHIHUAHUA = 'CHIHUAHUA';
    const STATE_COAHUILA = 'COAHUILA';
    const STATE_COLIMA = 'COLIMA';
    const STATE_DISTRITO_FEDERAL = 'DISTRITO FEDERAL';
    const STATE_DURANGO = 'DURANGO';
    const STATE_GUANAJUATO = 'GUANAJUATO';
    const STATE_GUERRERO = 'GUERRERO';
    const STATE_HIDALGO = 'HIDALGO';
    const STATE_JALISCO = 'JALISCO';
    const STATE_ESTADO_DE_MEXICO = 'ESTADO DE MEXICO';
    const STATE_MICHOACAN_DE_OCAMPO = 'MICHOACAN DE OCAMPO';
    const STATE_MORELOS = 'MORELOS';
    const STATE_NAYARIT = 'NAYARIT';
    const STATE_NUEVO_LEON = 'NUEVO LEON';
    const STATE_OAXACA = 'OAXACA';
    const STATE_PUEBLA = 'PUEBLA';
    const STATE_QUERETARO = 'QUERETARO';
    const STATE_QUINTANA_ROO = 'QUINTANA ROO';
    const STATE_SAN_LUIS_POTOSI = 'SAN LUIS POTOSI';
    const STATE_SINALOA = 'SINALOA';
    const STATE_SONORA = 'SONORA';
    const STATE_TABASCO = 'TABASCO';
    const STATE_TAMAULIPAS = 'TAMAULIPAS';
    const STATE_TLAXCALA = 'TLAXCALA';
    const STATE_VERACRUZ_DE_IGNACIO_DE_LA_LLAVE = 'VERACRUZ DE IGNACIO DE LA LLAVE';
    const STATE_YUCATAN = 'YUCATAN';
    const STATE_ZACATECAS = 'ZACATECAS';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $baseUri = self::API_URL;

    /**
     * @param string $user
     * @param string $password
     * @param array $requestOptions
     * @param null|ClientInterface $httpClient
     */
    public function __construct($user = null, $password = null, array $requestOptions = [], ClientInterface $httpClient = null)
    {
        if ($httpClient && $requestOptions) {
            throw new \InvalidArgumentException('If argument 3 is provided, argument 4 must be omitted or passed with `null` as value');
        }
        $requestOptions += [
            RequestOptions::HEADERS => ['User-Agent' => self::USER_AGENT],
            RequestOptions::AUTH => [$user, $password],
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::TIMEOUT => 60,
        ];
        $this->client = $httpClient ?: new GuzzleClient($requestOptions);
    }

    /**
     * @param string $baseUri
     *
     * @return Client
     */
    public function setApiUrl($baseUri)
    {
        $this->baseUri = rtrim($baseUri, '/');

        return $this;
    }

    /**
     * Get Request
     *
     * @param string $path
     * @param array $params
     *
     * @return null|\stdClass|array
     */
    public function get($path, array $params = [])
    {
        return $this->executeRequest('GET', $path, [RequestOptions::QUERY => $params]);
    }

    /**
     * POST Request
     *
     * @param string $path
     * @param array|null $body
     * @param array $params
     *
     * @return null|\stdClass|array
     */
    public function post($path, array $body = [], array $params = null)
    {
        return $this->executeRequest('POST', $path, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params]);
    }

    /**
     * PUT Request
     *
     * @param string $path
     * @param array|null $body
     * @param array $params
     *
     * @return null|\stdClass|array
     */
    public function put($path, array $body = null, array $params = [])
    {
        return $this->executeRequest('PUT', $path, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params]);
    }

    /**
     * DELETE Request
     *
     * @param string $path
     * @param array $params
     *
     * @return null|\stdClass|array
     */
    public function delete($path, array $params = [])
    {
        return $this->executeRequest('DELETE', $path, [RequestOptions::QUERY => $params]);
    }

    /**
     * Execute the request and return the resulting object
     *
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @throws \RuntimeException|\LogicException
     *
     * @return null|\stdClass|array The decoded JSON representation using `json_decode()`
     */
    private function executeRequest($method, $url, array $options = [])
    {
        try {
            $response = $this->client->request($method, sprintf('%s/%s', $this->baseUri, $url), $options);
            $content = trim($response->getBody()->getContents());
        } catch (GuzzleRequestException $e) {
            if ($e->hasResponse()) {
                $content = trim($e->getResponse()->getBody()->getContents());
                if ($content && ($object = \GuzzleHttp\json_decode($content)) && isset($object->Message)) {
                    $modelException = null;
                    if (isset($object->ModelState)) {
                        $modelExceptionMessages = [];
                        foreach ($object->ModelState as $invalidPropertyMessages) {
                            $modelExceptionMessages = array_merge($modelExceptionMessages, $invalidPropertyMessages);
                        }
                        $modelExceptionMessage = null;
                        if ($modelExceptionMessages) {
                            $modelExceptionMessage = implode('; ', $modelExceptionMessages).'.';
                        }
                        $modelException = new ModelException($modelExceptionMessage, $e->getCode());
                    }
                    throw new RequestException($object->Message, 0, $modelException);
                }

                throw new RequestException($content ?: $e->getMessage(), $e->getCode());
            }

            throw new RequestException($e->getMessage(), $e->getCode());
        }

        if ($content) {
            if (!($object = \GuzzleHttp\json_decode($content)) && JSON_ERROR_NONE !== ($jsonLastError = json_last_error())) {
                throw new ResponseException(
                    sprintf('Response body could not be parsed since it doesn\'t contain a valid JSON structure, %s (%d): %s', json_last_error_msg(), $jsonLastError, $content)
                );
            }

            return $object;
        }

        return null;
    }
}
