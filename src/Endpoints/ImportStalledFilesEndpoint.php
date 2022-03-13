<?php
namespace OrderSaga\Endpoints;

use OrderSaga\Client;
use OrderSaga\Exceptions\APIBadRequestException;
use OrderSaga\Exceptions\APIForbiddenException;
use OrderSaga\Exceptions\APIInternalServerErrorException;
use OrderSaga\Exceptions\APIResourceNotFoundException;
use OrderSaga\Exceptions\APIUnauthorizedException;
use GuzzleHttp\Exception\GuzzleException;

class ImportStalledFilesEndpoint extends Client
{
    protected $endpoint ='/import-stalled-files';

    /**
     * @param string $key
     * @param string $bucket
     * @param string $reason
     * @return mixed
     * @throws APIBadRequestException
     * @throws APIForbiddenException
     * @throws APIInternalServerErrorException
     * @throws APIResourceNotFoundException
     * @throws APIUnauthorizedException
     * @throws GuzzleException
     */
    public function add(string $key, string $bucket, string $reason)
    {
        return $this->post($this->endpoint, [
            'key'=>$key,
            'bucket'=>$bucket,
            'reason'=>$reason
        ]);
    }
}