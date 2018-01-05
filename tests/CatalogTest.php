<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Facturama\Tests;

use Facturama\Client;
use Facturama\Model\Catalog\PaymentForm;
use PHPUnit\Framework\TestCase;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class CatalogTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client(getenv('api_username'), getenv('api_password'));
    }

    public function testPaymentFormApi()
    {
        $this->assertNotEmpty(\stdClass::class, $this->client->get('catalogs/PaymentForms'));
    }

    /**
     * @dataProvider getPaymentForms
     */
    public function testPaymentForms($name, $value)
    {
        $this->assertSame($name, PaymentForm::findByName($name)['name']);
        $this->assertSame($value, PaymentForm::findByValue($value)['value']);
    }

    public function getPaymentForms()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        return \GuzzleHttp\json_decode(\GuzzleHttp\json_encode($client->get('catalogs/PaymentForms')), true);
    }
}
