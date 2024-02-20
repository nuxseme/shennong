<?php

namespace application\providers;

use application\DataCacheRepository;

class DataCacheRepositoryProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('dataCacheRepository', function ($app) {
            return new DataCacheRepository();
        });
    }
}