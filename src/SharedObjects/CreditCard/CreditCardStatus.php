<?php
namespace OrderSaga\SharedObjects\CreditCard;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class CreditCardStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const ACTIVE = 1;
    const EXPIRED = 2;
    const DELETED = 3;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
            self::ACTIVE=>'Active',
            self::EXPIRED=>'Expired',
            self::DELETED=>'Deleted'
        ];
    }
}