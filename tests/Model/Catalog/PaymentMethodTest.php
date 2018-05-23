<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Facturama\Tests\Model\Catalog;

use Facturama\Client;
use Facturama\Model\Catalog\PaymentMethod;
use Facturama\Tests\FacturamaBaseTest;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class PaymentMethodTest extends FacturamaBaseTest
{
    public function testPaymentMethodApi()
    {
        $this->assertNotEmpty($this->client->get('catalogs/PaymentMethods'));
    }

    /**
     * @dataProvider getPaymentMethods
     */
    public function testPaymentMethods(\stdClass $paymentMethod)
    {
        $this->assertObjectHasAttribute('Name', $paymentMethod);
        $this->assertSame($paymentMethod->Name, PaymentMethod::findByName($paymentMethod->Name)['name']);

        $this->assertObjectHasAttribute('Value', $paymentMethod);
        $this->assertSame($paymentMethod->Value, PaymentMethod::findByValue($paymentMethod->Value)['value']);
    }

    public function testNoUnusedPaymentMethods()
    {
        $apiPaymentMethods = $this->getPaymentMethods();
        $paymentMethods = PaymentMethod::CATALOG_PAYMENT_METHOD;

        foreach ($apiPaymentMethods as $paymentMethod) {
            $paymentMethod = reset($paymentMethod);
            if (false === $index = array_search($paymentMethod->Name, array_column(PaymentMethod::CATALOG_PAYMENT_METHOD, 'name'), true)) {
                $this->fail(sprintf('Payment method with name "%s" was not found', $paymentMethod->Name));
            }

            unset($paymentMethods[$index]);
        }

        $this->assertEmpty($paymentMethods);
    }

    /**
     * return \stdClass[]|\Generator
     */
    public function getPaymentMethods()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        foreach ($client->get('catalogs/PaymentMethods') as $paymentMethod) {
            yield [$paymentMethod];
        }
    }
}
