<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Supplier\Supplier;
use GuzzleHttp\Exception\GuzzleException;

class SupplierEndpoint extends Client
{
    protected $endpoint ='/supplier';

    /**
     * Gets a supplier's full details by ID
     *
     * @param int $supplier_id
     * @return Supplier
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getProduct(int $supplier_id)
    {
        $results = $this->get($this->endpoint, [
            'supplier_id' => $supplier_id,
        ]);

        return Supplier::create()->populateFromAPIResults($results);
    }
}