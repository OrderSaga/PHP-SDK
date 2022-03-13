<?php
namespace OrderSaga\SharedObjects\Payment;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class PaymentMethod implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //may not be a complete list
    const CREDIT_CARD = 1;
    const CHECK = 2;
    const WIRE_ACH = 3;
    const CRYPTOCURRENCY = 7;
    const CASH = 8;
    const PAYPAL = 9;
}