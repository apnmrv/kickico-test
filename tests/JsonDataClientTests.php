<?php
namespace Kickico\Tests;

use Kickico\JsonDataClient\JsonDataClient;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class JsonDataClientTests extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCanGetReponseBody()
    {
        $expResponseJson = json_encode($this->_getValidMockData());

        $responseBody = $this->_getMockedClient($expResponseJson)
            ->makeRequest('clientData')
            ->getBody();

        $this->assertEquals($responseBody, $expResponseJson);
    }

    public function testCanCheckIfResponseIsSuccessful()
    {
        $expResponseJson = json_encode($this->_getValidMockData());
        $success = $this->_getMockedClient($expResponseJson)
            ->makeRequest('clientData')
            ->isSuccessful("success");
        $this->assertTrue($success);

        $expResponseJson = json_encode($this->_getInValidMockData());
        $success = $this->_getMockedClient($expResponseJson)
            ->makeRequest('clientData')
            ->isSuccessful("success");
        $this->assertFalse($success);
    }

    public function testCanValidateResponseData()
    {
        $validResponseJson = json_encode($this->_getValidMockData());

        $isValid = $this->_getMockedClient($validResponseJson)
            ->makeRequest('clientData')
            ->isValid($this->_getValidationRules());

        $this->assertTrue($isValid);

        $invalidResponseJson = json_encode($this->_getInValidMockData());

        $isValid = $this->_getMockedClient($invalidResponseJson)
            ->makeRequest('clientData')
            ->isValid($this->_getValidationRules());

        $this->assertFalse($isValid);
    }

    protected function _getMockedClient(string $json)
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['X-Foo' => 'Bar'],
                $json
            ),
        ]);
        $handler = HandlerStack::create($mock);

        $guzzle = new Client(['handler' => $handler]);

        return new JsonDataClient($guzzle, app()->make('monolog'));
    }

    protected function _getPackageProviders($app)
    {
        return ['Kickico\JsonDataClient\JsonDataClientServiceProvider'];
    }

    protected function _getValidMockData()
    {
        return  [
            "data" => [
                "suggestions" => [
                    "region" => "Москва",
                    "value" => "г Москва, ул Лубянка Б., д 12",
                    "coordinates" => [
                        "geo_lat" => "55.7618518",
                        "geo_lon" => "37.6284306"
                    ]
                ]
            ],
            "success" => true
        ];
    }

    protected function _getInValidMockData()
    {
        return ["data" => [["code" => 1020, "message" => "Access forbidden"]],"success" => false];
    }

    protected function _getValidationRules()
    {
        return [
            'data' => 'required|array',
            'data.suggestions' => 'required|array',
            'data.suggestions.region' => 'required|string',
            'data.suggestions.value' => 'required|string',
            'data.suggestions.coordinates' => 'required|array',
            'data.suggestions.coordinates.geo_lat' => 'required|numeric',
            'data.suggestions.coordinates.geo_lon' => 'required|numeric',
            'success' => 'required|boolean',
        ];
    }
}
