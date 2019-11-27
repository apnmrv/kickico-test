<?php
namespace Kickico\JsonDataClient\Facades;

use Illuminate\Support\Facades\Facade;

class JsonDataClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'json-data-client';
    }
}
