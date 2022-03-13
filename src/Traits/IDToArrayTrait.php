<?php
namespace OrderSaga\Traits;

trait IDToArrayTrait
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId()
        ];
    }
}