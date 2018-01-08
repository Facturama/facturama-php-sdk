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
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class FacturamaBaseTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ClientInterface
     */
    private $customHttpClient;

    public function setUp()
    {
        $this->client = new Client(getenv('api_username'), getenv('api_password'));
        $this->customHttpClient = $this->getMock(GuzzleClient::class, [], [], '', false);
    }

    public function testCreateContact()
    {
        $this->markTestIncomplete('Complete this test');
    }

    public function testCustomHttpClient()
    {
        $client = $this->getMockBuilder(Client::class)
            ->setConstructorArgs([null, null, [], $this->customHttpClient])
            ->getMock()
        ;
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /If argument 3 is provided, argument 4 must be omitted or passed with `null` as value/
     */
    public function testCustomHttpClientWithRequestOptions()
    {
        $client = $this->getMockBuilder(Client::class)
            ->setConstructorArgs([null, null, ['verify' => false], $this->customHttpClient])
            ->getMock()
        ;
    }
}
