<?php
namespace OrderSaga\Interfaces;

interface DropdownInterface
{
    /**
     * @return array
     */
    public static function dropdownOptions(): array;
}