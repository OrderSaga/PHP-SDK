<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use OrderSaga\SharedObjects\Company\Company;
use GuzzleHttp\Exception\GuzzleException;

class CompanyEndpoint extends Client
{
    protected $endpoint ='/company';

    /**
     * Allows you to update a company's basic details
     *
     * @param Company $company
     * @return Company
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function updateCompany(Company &$company)
    {
        $results = $this->patch($this->endpoint, [
            'company'=>$company->toArray()
        ]);

        return $company->populateFromAPIResults($results);
    }

    /**
     * Gets the industry options for a dropdown.
     *
     * Key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getIndustryOptions()
    {
        return $this->get($this->endpoint.'/industries');
    }

    /**
     * Gets the payment terms options for a dropdown.
     *
     * Key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getPaymentTermOptions()
    {
        return $this->get($this->endpoint.'/payment-terms');
    }

    /**
     * Gets the employees/tradeshows/events options
     *
     * Multi-dimensional, first array has keys "num_employees", "num_tradeshows", "num_events".
     * Second array is associative: key is the id, value is the name
     *
     * @return array
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     * @throws \Exception
     */
    public function getNumberOf_Options()
    {
        return $this->get($this->endpoint.'/number-of');
    }
}