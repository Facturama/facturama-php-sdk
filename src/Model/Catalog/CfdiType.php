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
class CfdiType implements CatalogInterface
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
    const CFDI_TYPE_FEE = [
        'name' => 'Honorarios',
        'nameid' => 3,
        'value' => 'I',
    ];
    const CFDI_TYPE_PORTE_LETTER = [
        'name' => 'Carta Porte',
        'nameid' => 4,
        'value' => 'T',
    ];
    const CFDI_TYPE_RESTAURANT_INVOICE = [
        'name' => 'Factura para Restaurantes',
        'nameid' => 5,
        'value' => 'I',
    ];
    const CFDI_TYPE_GAS_STATION_INVOICE = [
        'name' => 'Factura para Gasolineras',
        'nameid' => 6,
        'value' => 'I',
    ];
    const CFDI_TYPE_INVOICE_WITH_TAX_WITHHOLDING = [
        'name' => 'Factura con Retención IVA',
        'nameid' => 7,
        'value' => 'I',
    ];
    const CFDI_TYPE_PHARMACY_INVOICE = [
        'name' => 'Factura para Farmacias',
        'nameid' => 8,
        'value' => 'I',
    ];
    const CFDI_TYPE_DEDUCTIBLE_RECEIPT = [
        'name' => 'Recibo Deducible',
        'nameid' => 9,
        'value' => 'I',
    ];
    const CFDI_TYPE_LEASE_RECEIPT = [
        'name' => 'Recibo de Arrendamiento',
        'nameid' => 10,
        'value' => 'I',
    ];
    const CFDI_TYPE_SALE_NOTE = [
        'name' => 'Nota de Venta',
        'nameid' => 11,
        'value' => 'I',
    ];
    const CFDI_TYPE_ESTIMATION_INVOICE = [
        'name' => 'Factura de Estimación',
        'nameid' => 12,
        'value' => 'I',
    ];
    const CFDI_TYPE_SINGLE_ESTIMATION_INVOICE = [
        'name' => 'Factura de Estimación Sencilla',
        'nameid' => 13,
        'value' => 'I',
    ];
    const CFDI_TYPE_PAYMENT_SUPPLEMENT = [
        'name' => 'Complemento de Pago',
        'nameid' => 14,
        'value' => 'P',
    ];
    const CFDI_TYPE_HOTEL_INVOICE = [
        'name' => 'Factura para Hoteles',
        'nameid' => 15,
        'value' => 'I',
    ];
    const CFDI_TYPE_PAYROLL_RECEIPT = [
        'name' => 'Recibo de Nómina',
        'nameid' => 16,
        'value' => 'E',
    ];
    const CFDI_TYPE_IEPS_INVOICE = [
        'name' => 'Factura con IEPS',
        'nameid' => 17,
        'value' => 'I',
    ];
    const CFDI_TYPE_PAYMENT_RECEIPT = [
        'name' => 'Recibo de Pago',
        'nameid' => 18,
        'value' => 'P',
    ];
    const CFDI_TYPE_SIMPLIFIED_ESTIMATION_INVOICE = [
        'name' => 'Factura de Estimación Simplificada',
        'nameid' => 19,
        'value' => 'I',
    ];
    const CFDI_TYPE_PARTIAL_CONSTRUCTION_SERVICE = [
        'name' => 'Servicio Parcial de Construcción',
        'nameid' => 20,
        'value' => 'I',
    ];
    const CFDI_TYPE_INE_INVOICE = [
        'name' => 'Factura INE',
        'nameid' => 21,
        'value' => 'I',
    ];
    const CFDI_TYPE_DETAILED_INVOICE = [
        'name' => 'Factura Detallista',
        'nameid' => 24,
        'value' => 'I',
    ];
    const CFDI_TYPE_PUBLIC_NOTARIES_INVOICE = [
        'name' => 'Factura para Notarios Publicos',
        'nameid' => 25,
        'value' => 'I',
    ];
    const CFDI_TYPE_FOREIGN_TRADE = [
        'name' => 'Factura Comercio Exterior',
        'nameid' => 26,
        'value' => 'I',
    ];
    const CFDI_TYPE_CREDIT_NOTE_FOREIGN_TRADE = [
        'name' => 'Nota de Crédito Comercio Exterior',
        'nameid' => 27,
        'value' => 'E',
    ];
    const CFDI_TYPE_PORTE_LETTER_FOREIGN_TRADE = [
        'name' => 'Carta Porte Comercio Exterior',
        'nameid' => 28,
        'value' => 'T',
    ];
    /**
     * @var array
     *
     * @see https://www.api.facturama.com.mx/api/catalogs/CfdiTypes
     */
    const CATALOG_CFDI_TYPE = [
        self::CFDI_TYPE_INVOICE,
        self::CFDI_TYPE_CREDIT_NOTE,
        self::CFDI_TYPE_FEE,
        self::CFDI_TYPE_PORTE_LETTER,
        self::CFDI_TYPE_RESTAURANT_INVOICE,
        self::CFDI_TYPE_GAS_STATION_INVOICE,
        self::CFDI_TYPE_INVOICE_WITH_TAX_WITHHOLDING,
        self::CFDI_TYPE_PHARMACY_INVOICE,
        self::CFDI_TYPE_DEDUCTIBLE_RECEIPT,
        self::CFDI_TYPE_LEASE_RECEIPT,
        self::CFDI_TYPE_SALE_NOTE,
        self::CFDI_TYPE_ESTIMATION_INVOICE,
        self::CFDI_TYPE_SINGLE_ESTIMATION_INVOICE,
        self::CFDI_TYPE_PAYMENT_SUPPLEMENT,
        self::CFDI_TYPE_HOTEL_INVOICE,
        self::CFDI_TYPE_PAYROLL_RECEIPT,
        self::CFDI_TYPE_IEPS_INVOICE,
        self::CFDI_TYPE_PAYMENT_RECEIPT,
        self::CFDI_TYPE_SIMPLIFIED_ESTIMATION_INVOICE,
        self::CFDI_TYPE_PARTIAL_CONSTRUCTION_SERVICE,
        self::CFDI_TYPE_INE_INVOICE,
        self::CFDI_TYPE_DETAILED_INVOICE,
        self::CFDI_TYPE_PUBLIC_NOTARIES_INVOICE,
        self::CFDI_TYPE_FOREIGN_TRADE,
        self::CFDI_TYPE_CREDIT_NOTE_FOREIGN_TRADE,
        self::CFDI_TYPE_PORTE_LETTER_FOREIGN_TRADE,
    ];

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
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
     * @throws \InvalidArgumentException
     *
     * @return \Generator The matching `CFDI_TYPE_*` constants for the given CFDI type value
     */
    public static function findByValue($value)
    {
        foreach (self::CATALOG_CFDI_TYPE as $cfdiType) {
            if ($cfdiType['value'] === $value) {
                yield $cfdiType;
            }
        }
    }
}
