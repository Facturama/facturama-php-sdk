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
use Facturama\Model\Catalog\PaymentForm;
use Facturama\Tests\FacturamaBaseTest;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class PaymentFormTest extends FacturamaBaseTest
{
    public function testPaymentFormApi()
    {
        $this->assertNotEmpty($this->client->get('catalogs/PaymentForms'));
    }

    /**
     * @dataProvider getPaymentForms
     */
    public function testPaymentForms(\stdClass $paymentForm)
    {
        $this->assertObjectHasAttribute('Name', $paymentForm);
        $this->assertSame($paymentForm->Name, PaymentForm::findByName($paymentForm->Name)['name']);

        $this->assertObjectHasAttribute('Value', $paymentForm);
        $this->assertSame($paymentForm->Value, PaymentForm::findByValue($paymentForm->Value)['value']);
    }

    public function testNoUnusedPaymentForms()
    {
        $apiPaymentForms = $this->getPaymentForms();
        $paymentForms = PaymentForm::CATALOG_PAYMENT_FORM;

        foreach ($apiPaymentForms as $paymentForm) {
            $paymentForm = reset($paymentForm);
            if (false === $index = array_search($paymentForm->Name, array_column(PaymentForm::CATALOG_PAYMENT_FORM, 'name'), true)) {
                $this->fail(sprintf('Payment form with name "%s" was not found', $paymentForm->Name));
            }

            unset($paymentForms[$index]);
        }

        $this->assertEmpty($paymentForms);
    }

    /**
     * return \stdClass[]|\Generator
     */
    public function getPaymentForms()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        foreach ($client->get('catalogs/PaymentForms') as $paymentForm) {
            yield [$paymentForm];
        }
    }
}
