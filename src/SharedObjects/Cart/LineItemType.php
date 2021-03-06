<?php
namespace OrderSaga\SharedObjects\Cart;

use OrderSaga\Interfaces\APIObjectInterface;
use OrderSaga\Traits\APIObjectTrait;
use OrderSaga\Traits\IDAndNameTrait;
use OrderSaga\Traits\IDToArrayTrait;

class LineItemType implements APIObjectInterface
{
    use APIObjectTrait;
    use IDAndNameTrait, IDToArrayTrait {
        IDToArrayTrait::toArray insteadof IDAndNameTrait;
    }

    /**
     * @var bool
     */
    private $isPerItemQuantity = false;

    /**
     * @var bool
     */
    private $isPerColorQuantity = false;

    /**
     * @param array $results
     * @return LineItemType
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setName($results['name']);

        $this->setIsPerColorQuantity((bool) $results['is_per_color_quantity']);
        $this->setIsPerItemQuantity((bool) $results['is_per_item_quantity']);

        return $this;
    }

    /**
     * @return bool
     */
    public function isPerItemQuantity(): bool
    {
        return $this->isPerItemQuantity;
    }

    /**
     * @param bool $isPerItemQuantity
     * @return LineItemType
     */
    public function setIsPerItemQuantity(bool $isPerItemQuantity): LineItemType
    {
        $this->isPerItemQuantity = $isPerItemQuantity;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPerColorQuantity(): bool
    {
        return $this->isPerColorQuantity;
    }

    /**
     * @param bool $isPerColorQuantity
     * @return LineItemType
     */
    public function setIsPerColorQuantity(bool $isPerColorQuantity): LineItemType
    {
        $this->isPerColorQuantity = $isPerColorQuantity;
        return $this;
    }
}