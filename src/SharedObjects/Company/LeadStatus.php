<?php
namespace OrderSaga\SharedObjects\Company;

use OrderSaga\Interfaces\DropdownInterface;
use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class LeadStatus implements APIObjectInterface, DropdownInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    const OPEN = 1;
    const CONTACTED = 2;
    const UNQUALIFIED = 3;

    /**
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return [
          self::OPEN=>'Open',
          self::CONTACTED=>'Contacted',
          self::UNQUALIFIED=>'Unqualified'
        ];
    }
}