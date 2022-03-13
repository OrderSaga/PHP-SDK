<?php
namespace OrderSaga\SharedObjects\Order;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class OrderStatus implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    //not a complete list (others are subject to change, it's best you avoid hardcoding them)
    const COMPLETED = 20;
}