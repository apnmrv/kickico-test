<?php
namespace Kickico\JsonDataClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Validator;
use Monolog\Logger;

class JsonDataClient
{
    /**
     * @var GuzzleClient
     */
    private $__guzzle;
    /**
     * @var Response
     */
    private $__response = null;
    /**
     * @var Logger
     */
    private $__logger;

    /**
     * JsonDataClient constructor.
     * @param GuzzleClient $guzzle
     * @param Logger $logger
     */
    public function __construct(GuzzleClient $guzzle, Logger $logger)
    {
        $this->__guzzle = $guzzle;
        $this->__logger = $logger;
    }

    public function makeRequest(string $url)
    {
        try
        {
            $this->__response = $this->__guzzle->request('GET', $url);
        }
        catch(RequestException $e)
        {
            $this->__logger->error($e->getRequest());
            if ($e->hasResponse()) {
                $this->logger->error($e->getResponse());
            }
        }

        return $this;
    }

    public function getResponse()
    {
        return $this->__response;
    }

    public function getBody()
    {
        return $this->__response->getBody();
    }

    public function getHeaders()
    {
        return $this->__response->getHeaders();
    }

    public function isValid(array $rules)
    {
        $dataArray = json_decode($this->__response->getBody(), true);

        $validator = Validator::make($dataArray, $rules);

        return !$validator->fails();
    }

    public function isSuccessful($fieldToCheck)
    {
        $result = false;

        $data = json_decode($this->__response->getBody());

        if(isset($data->{$fieldToCheck}))
        {
            $result = boolval($data->{$fieldToCheck});
        }

        return $result;
    }
}
