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
use Facturama\Model\Catalog\CfdiUse;
use Facturama\Tests\FacturamaBaseTest;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class CfdiUseTest extends FacturamaBaseTest
{
    public function testCfdiUseApi()
    {
        $this->assertNotEmpty($this->client->get('catalogs/CfdiUses'));
    }

    /**
     * @dataProvider getCfdiUses
     */
    public function testCfdiUses(\stdClass $cfdiUse)
    {
        $this->assertObjectHasAttribute('Name', $cfdiUse);
        $this->assertSame($cfdiUse->Name, CfdiUse::findByName($cfdiUse->Name)['name']);

        $this->assertObjectHasAttribute('Value', $cfdiUse);
        $this->assertSame($cfdiUse->Value, CfdiUse::findByValue($cfdiUse->Value)['value']);

        $this->assertObjectHasAttribute('Moral', $cfdiUse);
        $this->assertSame($cfdiUse->Moral, CfdiUse::findByName($cfdiUse->Name)['moral']);

        $this->assertObjectHasAttribute('Natural', $cfdiUse);
        $this->assertSame($cfdiUse->Natural, CfdiUse::findByName($cfdiUse->Name)['natural']);
    }

    public function testNoUnusedCfdiUses()
    {
        $apiCfdiUses = $this->getCfdiUses();
        $cfdiUses = CfdiUse::CATALOG_CFDI_USE;

        foreach ($apiCfdiUses as $cfdiUse) {
            $cfdiUse = reset($cfdiUse);
            if (false === $index = array_search($cfdiUse->Name, array_column(CfdiUse::CATALOG_CFDI_USE, 'name'), true)) {
                $this->fail(sprintf('CFDI use with name "%s" was not found', $cfdiUse->Name));
            }

            unset($cfdiUses[$index]);
        }

        $this->assertEmpty($cfdiUses);
    }

    /**
     * return \stdClass[]|\Generator
     */
    public function getCfdiUses()
    {
        $client = new Client(getenv('api_username'), getenv('api_password'));

        // RFC with 12 chars length
        foreach ($client->get('catalogs/CfdiUses', ['keyword' => 'AAAA12345678']) as $cfdiUse) {
            yield [$cfdiUse];
        }

        // RFC with 13 chars length
        foreach ($client->get('catalogs/CfdiUses', ['keyword' => 'AAAA123456789']) as $cfdiUse) {
            yield [$cfdiUse];
        }
    }
}
