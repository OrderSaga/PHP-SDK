<?php
namespace OrderSaga\SharedObjects\CreditCard;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class CreditCardType implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const VISA = 1;
    const MASTERCARD = 2;
    const DISCOVER = 3;
    const AMEX = 4;
    const DINERS_CLUB_CARTE_BLANCE = 5;
    const DINERS_CLUB_ENROUTE = 6;
    const JCB = 7;
    const MAESTRO = 8;
    const BANKCARD = 11;
    const CHINA_UNIONPAY = 12;
    const DINERS_CLUB_INTERNATIONAL = 13;
    const INTERPAYMENT = 15;
    const INSTAPAYMENT = 16;
    const LASER = 17;
    const DANKORT = 18;
    const NSPK_MIR = 19;
    const SOLO = 20;
    const SWITCH = 21;
    const UATP = 22;
    const VERVE = 23;
    const CARDGUARD_EAD_BG_ILS = 24;

    /**
     * Not a complete list, just the most popular are provided
     * The remaining are listed above as constants
     *
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
          self::VISA=>'Visa',
          self::MASTERCARD=>'Mastercard',
          self::DISCOVER=>'Discover',
          self::AMEX=>'AMEX',
        ];
    }
}