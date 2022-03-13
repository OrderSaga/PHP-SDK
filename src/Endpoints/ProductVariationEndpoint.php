<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Cart\Cart;
use OrderSaga\SharedObjects\Cart\ProductVariation;
use GuzzleHttp\Exception\GuzzleException;

class ProductVariationEndpoint extends Client
{
    protected $endpoint ='/cart/line-item';

    /**
     * Gets a product variation from a cart
     *
     * @param int $variation_id
     * @return ProductVariation
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProductVariation(int $variation_id)
    {
        $results = $this->get($this->endpoint, [
            'line_item_id' => $variation_id,
        ]);

        return ProductVariation::create()->populateFromAPIResults($results);
    }

    /**
     * Updates a product variation in a cart
     *
     * $data can contain values for quantity, cost, price and more
     *
     * @param int $variation_id
     * @param array $data
     * @return ProductVariation
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateVariation(int $variation_id, array $data = [])
    {
        $results = $this->patch($this->endpoint, [
            'line_item_id'=>$variation_id,
            'data'=>$data
        ]);

        return ProductVariation::create()->populateFromAPIResults($results);
    }

    /**
     * Removes a product variation from a cart
     *
     * @param int $variation_id
     * @return Cart|null
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function removeVariation(int $variation_id)
    {
        return $this->delete($this->endpoint, [
            'line_item_id'=>$variation_id
        ]);
    }
}