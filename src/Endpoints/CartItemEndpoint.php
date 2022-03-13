<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Cart\Cart;
use OrderSaga\SharedObjects\Cart\CartItem;
use GuzzleHttp\Exception\GuzzleException;

class CartItemEndpoint extends Client
{
    protected $endpoint ='/cart/item';

    /**
     * Gets an item from a cart
     *
     * @param int $cart_item_id
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getItem(int $cart_item_id)
    {
        $results = $this->get($this->endpoint, [
            'cart_item_id' => $cart_item_id,
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Adds an item to a cart
     *
     * $data can contain values for cost_per_unit, price_per_unit, decoration, attributes, and more
     *
     * @param int $user_id
     * @param int $product_id
     * @param int $quantity
     * @param array $data
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function addItem(int $user_id, int $product_id, int $quantity, array $data = [])
    {
        $results = $this->post($this->endpoint, [
            'user_id' => $user_id,
            'product_id'=>$product_id,
            'quantity'=>$quantity,
            'data'=>$data
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Updates an item in a cart
     *
     * $data can contain values for quantity, cost_per_unit, price_per_unit, decoration, attributes and more
     *
     * @param int $cart_item_id
     * @param array $data
     * @return CartItem
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateItem(int $cart_item_id, array $data = [])
    {
        $results = $this->patch($this->endpoint, [
            'cart_item_id'=>$cart_item_id,
            'data'=>$data
        ]);

        return CartItem::create()->populateFromAPIResults($results);
    }

    /**
     * Removes an item from a cart
     *
     * @param int $cart_item_id
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeItem(int $cart_item_id)
    {
        return $this->delete($this->endpoint, [
            'cart_item_id'=>$cart_item_id
        ]);
    }
}