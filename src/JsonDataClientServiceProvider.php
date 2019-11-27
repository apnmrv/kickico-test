<?php

namespace Kickico\JsonDataClient;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class JsonDataClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

    }

    public function register()
    {
        $this->app->singleton('Kickico\JsonDataClient\JsonDataClient', function ($app) {
            return new JsonDataClient(new Client(), new Logger('monolog'));
        });

        $this->app->bind('monolog', function($app) {
            return new Logger('monolog');
        });
    }
}
