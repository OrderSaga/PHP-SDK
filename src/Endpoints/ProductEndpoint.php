<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Product\Product;
use OrderSaga\SharedObjects\Product\UnavailableProduct;
use GuzzleHttp\Exception\GuzzleException;

class ProductEndpoint extends Client
{
    protected $endpoint ='/product';

    /**
     * Gets a product's full details by ID
     *
     * @param int $product_id
     * @param int $include_how_many_related_products
     * @return Product
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProduct(int $product_id, int $include_how_many_related_products = 0)
    {
        $results = $this->get($this->endpoint, [
            'product_id' => $product_id,
            'include_related' => $include_how_many_related_products
        ]);

        if( $results['is_available'] != '1' )
        {
            return UnavailableProduct::create()->populateFromAPIResults($results);
        }

        return Product::create()->populateFromAPIResults($results);
    }
}