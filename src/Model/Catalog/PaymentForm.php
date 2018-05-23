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
class PaymentForm implements CatalogInterface
{
    const PAYMENT_FORM_CASH = [
        'name' => 'Efectivo',
        'value' => '01',
    ];
    const PAYMENT_FORM_NOMINAL_CHECK = [
        'name' => 'Cheque nominativo',
        'value' => '02',
    ];
    const PAYMENT_FORM_TRANSFER = [
        'name' => 'Transferencia electrónica de fondos',
        'value' => '03',
    ];
    const PAYMENT_FORM_CREDIT_CARD = [
        'name' => 'Tarjeta de crédito',
        'value' => '04',
    ];
    const PAYMENT_FORM_DIGITAL_WALLET = [
        'name' => 'Monedero electrónico',
        'value' => '05',
    ];
    const PAYMENT_FORM_DIGITAL_MONEY = [
        'name' => 'Dinero electrónico',
        'value' => '06',
    ];
    const PAYMENT_FORM_GROCERY_COUPON = [
        'name' => 'Vales de despensa',
        'value' => '08',
    ];
    const PAYMENT_FORM_DATION = [
        'name' => 'Dación en pago',
        'value' => '12',
    ];
    const PAYMENT_FORM_SUBROGATION = [
        'name' => 'Pago por subrogación',
        'value' => '13',
    ];
    const PAYMENT_FORM_CONSIGNMENT = [
        'name' => 'Pago por consignación',
        'value' => '14',
    ];
    const PAYMENT_FORM_CONDONATION = [
        'name' => 'Condonación',
        'value' => '15',
    ];
    const PAYMENT_FORM_COMPENSATION = [
        'name' => 'Compensación',
        'value' => '17',
    ];
    const PAYMENT_FORM_NOVATION = [
        'name' => 'Novación',
        'value' => '23',
    ];
    const PAYMENT_FORM_CONFUSION = [
        'name' => 'Confusión',
        'value' => '24',
    ];
    const PAYMENT_FORM_DEBT_REMITTANCE = [
        'name' => 'Remisión de deuda',
        'value' => '25',
    ];
    const PAYMENT_FORM_PRESCRIPTION = [
        'name' => 'Prescripción o caducidad',
        'value' => '26',
    ];
    const PAYMENT_FORM_CREDITOR_SATISFACTION = [
        'name' => 'A satisfacción del acreedor',
        'value' => '27',
    ];
    const PAYMENT_FORM_DEBIT_CARD = [
        'name' => 'Tarjeta de débito',
        'value' => '28',
    ];
    const PAYMENT_FORM_SERVICE_CARD = [
        'name' => 'Tarjeta de servicios',
        'value' => '29',
    ];
    const PAYMENT_FORM_APPLICATION_OF_ADVANCES = [
        'name' => 'Aplicación de anticipos',
        'value' => '30',
    ];
    const PAYMENT_FORM_INTERMEDIARIES = [
        'name' => 'Intermediarios',
        'value' => '31',
    ];
    const PAYMENT_FORM_TO_BE_DEFINED = [
        'name' => 'Por definir',
        'value' => '99',
    ];

    /**
     * @var array
     *
     * @see https://www.api.facturama.com.mx/api/catalogs/PaymentForms
     */
    const CATALOG_PAYMENT_FORM = [
        self::PAYMENT_FORM_CASH,
        self::PAYMENT_FORM_NOMINAL_CHECK,
        self::PAYMENT_FORM_TRANSFER,
        self::PAYMENT_FORM_CREDIT_CARD,
        self::PAYMENT_FORM_DIGITAL_WALLET,
        self::PAYMENT_FORM_DIGITAL_MONEY,
        self::PAYMENT_FORM_GROCERY_COUPON,
        self::PAYMENT_FORM_DATION,
        self::PAYMENT_FORM_SUBROGATION,
        self::PAYMENT_FORM_CONSIGNMENT,
        self::PAYMENT_FORM_CONDONATION,
        self::PAYMENT_FORM_COMPENSATION,
        self::PAYMENT_FORM_NOVATION,
        self::PAYMENT_FORM_CONFUSION,
        self::PAYMENT_FORM_DEBT_REMITTANCE,
        self::PAYMENT_FORM_PRESCRIPTION,
        self::PAYMENT_FORM_CREDITOR_SATISFACTION,
        self::PAYMENT_FORM_DEBIT_CARD,
        self::PAYMENT_FORM_SERVICE_CARD,
        self::PAYMENT_FORM_APPLICATION_OF_ADVANCES,
        self::PAYMENT_FORM_INTERMEDIARIES,
        self::PAYMENT_FORM_TO_BE_DEFINED,
    ];

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return array The matching `PAYMENT_FORM_*` constant for the given payment form name
     */
    public static function findByName($name)
    {
        if (false === $index = array_search($name, array_column(self::CATALOG_PAYMENT_FORM, 'name'), true)) {
            throw new \InvalidArgumentException(sprintf('Payment form with name "%s" was not found', $name));
        }

        return self::CATALOG_PAYMENT_FORM[$index];
    }

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return array The matching `PAYMENT_FORM_*` constant for the given payment form value
     */
    public static function findByValue($value)
    {
        if (false === $index = array_search($value, array_column(self::CATALOG_PAYMENT_FORM, 'value'), true)) {
            throw new \InvalidArgumentException(sprintf('Payment form with value "%s" was not found', $value));
        }

        return self::CATALOG_PAYMENT_FORM[$index];
    }
}
