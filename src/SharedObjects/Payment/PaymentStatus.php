<?php
namespace OrderSaga\SharedObjects\Payment;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class PaymentStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const INVOICE_NOT_SENT = 1;
    const INVOICE_SENT = 2;
    const PAID = 3;
    const REFUNDED = 4;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
          self::INVOICE_NOT_SENT=>'Invoice Not Sent',
          self::INVOICE_SENT=>'Invoice Sent',
          self::PAID=>'Paid',
          self::REFUNDED=>'Refunded'
        ];
    }
}