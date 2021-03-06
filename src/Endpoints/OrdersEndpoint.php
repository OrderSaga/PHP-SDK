<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Order\Order;
use GuzzleHttp\Exception\GuzzleException;

class OrdersEndpoint extends Client
{
    protected $endpoint ='/orders';

    /**
     * Gets previous orders for a user. You can choose to include the items if you want to display the full order,
     * or just grab the generic details if you want to show them in a list
     *
     * @param int $user_id
     * @param bool $include_items
     * @param bool $include_payments
     * @param bool $include_shipments
     * @return Order[]|array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getOrdersForUser(int $user_id, bool $include_items = true, bool $include_payments = true, bool $include_shipments = true)
    {
        //endpoint is /orders
        $results = $this->get($this->endpoint, [
            'user_id' => $user_id,
            'include_items'=>$include_items,
            'include_payments'=>$include_payments,
            'include_shipments'=>$include_shipments
        ]);

        $orders = [];
        if( $results )
        {
            foreach($results as $result)
            {
                $orders[] = Order::create()->populateFromAPIResults($result);
            }
        }

        return $orders;
    }
}