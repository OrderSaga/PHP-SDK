<?php
namespace OrderSaga\SharedObjects\Order;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class ShippingCarrier implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //not a complete list
    const USPS = 1;
    const FEDEX = 2;
    const UPS = 3;
    const DHL_EXPRESS = 4;
    const LASERSHIP = 15;
    const CANADA_POST = 16;
    const AUSTRALIA_POST = 17;
    // ..

}