<?php
namespace OrderSaga\SharedObjects\Company;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class NumberOfEmployees implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const ONE_TO_TEN = 1;
    const ELEVEN_TO_TWENTY = 2;
    const TWENTY_ONE_TO_FIFTY = 3;
    const FIFTY_ONE_TO_SEVENTY_FIVE = 4;
    const ONE_HUNDRED_AND_ONE_TO_ONE_FIFTY = 5;
    const ONE_FIFTY_ONE_TO_TWO_HUNDRED = 6;
    const TWO_HUNDRED_AND_ONE_AND_ABOVE = 7;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
            self::ONE_TO_TEN=>'1-10',
            self::ELEVEN_TO_TWENTY=>'11-20',
            self::TWENTY_ONE_TO_FIFTY=>'21-50',
            self::FIFTY_ONE_TO_SEVENTY_FIVE=>'51-75',
            self::ONE_HUNDRED_AND_ONE_TO_ONE_FIFTY=>'101-150',
            self::ONE_FIFTY_ONE_TO_TWO_HUNDRED=>'151-200',
            self::TWO_HUNDRED_AND_ONE_AND_ABOVE=>'201+',
        ];
    }
}