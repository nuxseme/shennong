<?php


namespace application\providers;



use application\FieldFilter;

class FieldFilterServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('fieldFilter', function ($app) {
            return new FieldFilter($app);
        });
    }
}