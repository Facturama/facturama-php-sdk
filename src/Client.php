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
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

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
     * @param array $config
     */
    public function __construct($user = null, $password = null, array $config = [])
    {
        $this->client = new GuzzleClient($config + ['headers' => ['User-Agent' => self::USER_AGENT]]);
        $this->client->setDefaultOption('verify', false);
        $this->client->setDefaultOption('auth', [$user, $password]);
        $this->client->setDefaultOption('connect_timeout', 10);
        $this->client->setDefaultOption('timeout', 60);
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
        return $this->executeRequest('GET', $path, ['query' => $params]);
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
        return $this->executeRequest('POST', $path, ['json' => $body, 'query' => $params]);
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
        return $this->executeRequest('PUT', $path, ['json' => $body, 'query' => $params]);
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
        return $this->executeRequest('DELETE', $path, ['query' => $params]);
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
            $request = $this->client->createRequest($method, sprintf('%s/%s', self::API_URL, $url), $options);
            $response = $this->client->send($request);
            $content = trim($response->getBody()->getContents());
        } catch (GuzzleRequestException $e) {
            if ($e->hasResponse()) {
                $content = trim($e->getResponse()->getBody()->getContents());
                if (($object = json_decode($content)) && isset($object->Message)) {
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

        return json_decode($content);
    }
}
