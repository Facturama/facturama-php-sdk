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
use Facturama\Model\Catalog\FederalTax;
use Facturama\Tests\FacturamaBaseTest;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class FederalTaxTest extends FacturamaBaseTest
{
    public function testFederalTaxApi()
    {
        $this->assertNotEmpty($this->client->get('catalogs/FederalTaxes'));
    }

    /**
     * @dataProvider getFederalTaxes
     */
    public function testFederalTaxes(\stdClass $federalTax)
    {
        $this->assertObjectHasAttribute('Name', $federalTax);
        $this->assertSame($federalTax->Name, FederalTax::findByName($federalTax->Name)['name']);

        $this->assertObjectHasAttribute('Value', $federalTax);
        $this->assertSame($federalTax->Value, FederalTax::findByValue($federalTax->Value)['value']);
    }

    public function testNoUnusedFederalTaxes()
    {
        $apiFederalTaxes = $this->getFederalTaxes();
        $paymentForms = FederalTax::CATALOG_FEDERAL_TAX;

        foreach ($apiFederalTaxes as $federalTax) {
            $federalTax = reset($federalTax);
            if (false === $index = array_search($federalTax->Name, array_column(FederalTax::CATALOG_FEDERAL_TAX, 'name'), true)) {
                $this->fail(sprintf('Federal tax with name "%s" was not found', $federalTax->Name));
            }

            unset($paymentForms[$index]);
        }

        $this->assertEmpty($paymentForms);
    }

    /**
     * return \stdClass[]|\Generator
     */
    public function getFederalTaxes()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        foreach ($client->get('catalogs/FederalTaxes') as $paymentForm) {
            yield [$paymentForm];
        }
    }
}
