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
use Facturama\Model\Catalog\CfdiType;
use Facturama\Tests\FacturamaBaseTest;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class CfdiTypeTest extends FacturamaBaseTest
{
    public function testCfdiTypeApi()
    {
        $this->assertNotEmpty($this->client->get('catalogs/CfdiTypes'));
    }

    /**
     * @dataProvider getCfdiTypes
     */
    public function testCfdiTypes(\stdClass $cfdiType)
    {
        $this->assertObjectHasAttribute('Name', $cfdiType);
        $this->assertSame($cfdiType->Name, CfdiType::findByName($cfdiType->Name)['name']);

        $this->assertObjectHasAttribute('Value', $cfdiType);
        $this->assertInstanceOf(\Generator::class, CfdiType::findByValue($cfdiType->Value));
        $this->assertObjectHasAttribute('NameId', $cfdiType);
        $this->assertContains(['name' => $cfdiType->Name, 'nameid' => $cfdiType->NameId, 'value' => $cfdiType->Value], CfdiType::findByValue($cfdiType->Value));
    }

    public function testNoUnusedCfdiTypes()
    {
        $apiCfdiTypes = $this->getCfdiTypes();
        $cfdiTypes = CfdiType::CATALOG_CFDI_TYPE;

        foreach ($apiCfdiTypes as $cfdiType) {
            $cfdiType = reset($cfdiType);
            if (false === $index = array_search($cfdiType->Name, array_column(CfdiType::CATALOG_CFDI_TYPE, 'name'), true)) {
                $this->fail(sprintf('CFDI type with name "%s" was not found', $cfdiType->Name));
            }

            unset($cfdiTypes[$index]);
        }

        $this->markTestIncomplete('CFDI types are tied to the configured account, so until there are a static test account, this check must be skipped');
        $this->assertEmpty($cfdiTypes);
    }

    /**
     * return \stdClass[]|\Generator
     */
    public function getCfdiTypes()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        foreach ($client->get('catalogs/CfdiTypes') as $cfdiType) {
            yield [$cfdiType];
        }
    }
}
