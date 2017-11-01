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
    const VERSION = '1.0.0';
    const API_URL = 'https://www.api.facturama.com.mx/api';
    const USER_AGENT = 'Facturama-PHP-SDK-v1.0.0';

    const INVOICE_TYPE_INCOME = 'ingreso';
    const INVOICE_TYPE_OUTCOME = 'egreso';
    const INVOICE_TYPE_DELIVERY_NOTE = 'traslado';

    const PAYMENT_METHOD_CASH = 'Efectivo';
    const PAYMENT_METHOD_NOMINAL_CHECK = 'Cheque';
    const PAYMENT_METHOD_TRANSFER = 'Transferencia';
    const PAYMENT_METHOD_CREDIT_CARD = 'Tarjetas de crédito';
    const PAYMENT_METHOD_DIGITAL_WALLET = 'Monederos electrónicos';
    const PAYMENT_METHOD_DIGITAL_MONEY = 'Dinero electrónico';
    const PAYMENT_METHOD_DIGITAL_CARD = 'Tarjetas digitales';
    const PAYMENT_METHOD_GROCERY_COUPON = 'Vales de despensa';
    const PAYMENT_METHOD_HOLDING = 'Bienes';
    const PAYMENT_METHOD_SERVICE = 'Servicio';
    const PAYMENT_METHOD_THIRD_PARTY = 'Por cuenta de tercero';
    const PAYMENT_METHOD_DATION = 'Dación en pago';
    const PAYMENT_METHOD_SUBROGATION = 'Pago por subrogación';
    const PAYMENT_METHOD_CONSIGNMENT = 'Pago por consignación';
    const PAYMENT_METHOD_CONDONATION = 'Condonación';
    const PAYMENT_METHOD_CANCELLATION = 'Cancelación';
    const PAYMENT_METHOD_COMPENSATION = 'Compensación';
    const PAYMENT_METHOD_DOESNT_APPLY = 'NA';
    const PAYMENT_METHOD_OTHER = 'Otros';

    const FILE_TYPE_PDF = 'pdf';
    const FILE_TYPE_HTML = 'html';
    const FILE_TYPE_XML = 'xml';

    const RECEIPT_PAYROLL = 'payroll';
    const RECEIPT_RECEIVED = 'received';
    const RECEIPT_ISSUED = 'issued';

    const TAX_TYPE_FEDERAL_RETAINED = 1;
    const TAX_TYPE_FEDERAL_TRANSFERRED = 2;
    const TAX_TYPE_LOCAL_RETAINED = 3;
    const TAX_TYPE_LOCAL_TRANSFERRED = 4;

    /**
     * @var ClientInterface
     */
    private $client;

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
     * Get Request
     *
     * @param string $path
     * @param array $params
     *
     * @return \stdClass
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
     * @return \stdClass
     */
    public function post($path, array $body = null, array $params = [])
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
     * @return \stdClass
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
     * @return \stdClass
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
     * @return \stdClass
     */
    private function executeRequest($method, $url, array $options = [])
    {
        try {
            $response = $this->client->request($method, sprintf('%s/%s', self::API_URL, $url), $options);
            $content = trim($response->getBody()->getContents());
        } catch (GuzzleRequestException $e) {
            if ($e->hasResponse()) {
                $content = trim($e->getResponse()->getBody()->getContents());
                if (($object = \GuzzleHttp\json_decode($content)) && isset($object->Message)) {
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

        if (!($object = \GuzzleHttp\json_decode($content)) && JSON_ERROR_NONE !== ($jsonLastError = json_last_error())) {
            throw new ResponseException(
                sprintf('Response body could not be parsed since it doesn\'t contain a valid JSON structure, %s (%d): %s', json_last_error_msg(), $jsonLastError, $content)
            );
        }

        return $object;
    }
}
