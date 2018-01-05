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
class CfdiType
{
    const CFDI_TYPE_INVOICE = [
        'name' => 'Factura',
        'nameid' => 1,
        'value' => 'I',
    ];
    const CFDI_TYPE_CREDIT_NOTE = [
        'name' => 'Nota de Crédito',
        'nameid' => 2,
        'value' => 'E',
    ];
    const CFDI_TYPE_INVOICE_WITH_TAX_WITHHOLDING = [
        'name' => 'Factura con Retención IVA',
        'nameid' => 7,
        'value' => 'I',
    ];

    /**
     * @var array
     *
     * @see https://www.api.facturama.com.mx/api/catalogs/CfdiTypes
     */
    const CATALOG_CFDI_TYPE = [
        self::CFDI_TYPE_INVOICE,
        self::CFDI_TYPE_CREDIT_NOTE,
        self::CFDI_TYPE_INVOICE_WITH_TAX_WITHHOLDING,
    ];

    /**
     * @param string $name
     *
     * @throws InvalidArgumentException
     *
     * @return array The matching `CFDI_TYPE_*` constant for the given CFDI type name
     */
    public static function findByName($name)
    {
        if (false === $index = array_search($name, array_column(self::CATALOG_CFDI_TYPE, 'name'), true)) {
            throw new \InvalidArgumentException(sprintf('CFDI type with name "%s" was not found', $name));
        }

        return self::CATALOG_CFDI_TYPE[$index];
    }

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return array The matching `CFDI_TYPE_*` constant for the given CFDI type value
     */
    public static function findByValue($value)
    {
        if (false === $index = array_search($value, array_column(self::CATALOG_CFDI_TYPE, 'value'), true)) {
            throw new \InvalidArgumentException(sprintf('CFDI type with value "%s" was not found', $value));
        }

        return self::CATALOG_CFDI_TYPE[$index];
    }
}
