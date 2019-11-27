<?php

namespace Kickico\JsonDataClient\Http;

use GuzzleHttp\Client;

class GuzzleClientProvider
{
    public static function getClient(RequestOptions $options)
    {
        return new Client(
            $options->getBaseUri(),
            $options->getTimeout(),
            $options->isAllowRedirects(),
            $options->getProxyIp(),
        );
    }
}
