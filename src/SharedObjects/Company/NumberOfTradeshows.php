<?php
namespace OrderSaga\SharedObjects\Company;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class NumberOfTradeshows implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const ONE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const FIVE_AND_ABOVE = 5;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
            self::ONE=>1,
            self::TWO=>2,
            self::THREE=>3,
            self::FOUR=>4,
            self::FIVE_AND_ABOVE=>'5+'
        ];
    }
}