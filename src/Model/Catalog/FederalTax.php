<?php

/*
 * This file is part of Facturama PHP SDK.
 *
 * (c) Facturama <dev@facturama.com>
 *
 * This source file is subject to a MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Facturama\Model\Catalog;

/**
 * @author Javier Spagnoletti <phansys@gmail.com>
 */
class FederalTax implements CatalogInterface
{
    const FEDERAL_TAX_IEPS = [
        'name' => 'IEPS',
        'value' => '003',
    ];
    const FEDERAL_TAX_IEPS_RET = [
        'name' => 'IEPS RET',
        'value' => '003',
    ];
    const FEDERAL_TAX_ISR = [
        'name' => 'ISR',
        'value' => '001',
    ];
    const FEDERAL_TAX_IVA = [
        'name' => 'IVA',
        'value' => '002',
    ];
    const FEDERAL_TAX_IVA_RET = [
        'name' => 'IVA RET',
        'value' => '002',
    ];

    /**
     * @var array
     *
     * @see https://www.api.facturama.com.mx/api/catalogs/FederalTaxes
     */
    const CATALOG_FEDERAL_TAX = [
        self::FEDERAL_TAX_IEPS,
        self::FEDERAL_TAX_IEPS_RET,
        self::FEDERAL_TAX_ISR,
        self::FEDERAL_TAX_IVA,
        self::FEDERAL_TAX_IVA_RET,
    ];

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return array The matching `FEDERAL_TAX_*` constant for the given federal tax name
     */
    public static function findByName($name)
    {
        if (false === $index = array_search($name, array_column(self::CATALOG_FEDERAL_TAX, 'name'), true)) {
            throw new \InvalidArgumentException(sprintf('Federal tax with name "%s" was not found', $name));
        }

        return self::CATALOG_FEDERAL_TAX[$index];
    }

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return array The matching `FEDERAL_TAX_*` constant for the given federal tax value
     */
    public static function findByValue($value)
    {
        if (false === $index = array_search($value, array_column(self::CATALOG_FEDERAL_TAX, 'value'), true)) {
            throw new \InvalidArgumentException(sprintf('Federal tax with value "%s" was not found', $value));
        }

        return self::CATALOG_FEDERAL_TAX[$index];
    }
}
