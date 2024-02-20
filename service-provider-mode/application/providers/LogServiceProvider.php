<?php


namespace application\providers;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('log', function ($app) {
            return (new Logger('xm_field'))->pushHandler(new StreamHandler('php://stderr'));
        });
    }
}