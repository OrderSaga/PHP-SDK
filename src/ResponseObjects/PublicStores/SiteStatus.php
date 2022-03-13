<?php
namespace OrderSaga\ResponseObjects\PublicStores;

use OrderSaga\Traits\CreateTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class SiteStatus
{
    use CreateTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }
}