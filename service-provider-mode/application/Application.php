<?php

namespace application;

use application\providers\DataCacheRepositoryProvider;
use application\providers\FieldFilterServiceProvider;
use Illuminate\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * 应用容器主体
 * 用于初始化依赖，注册逻辑处理器 不处理业务逻辑
 *
 * Class Application
 * @package application
 */
class Application extends Container
{
    public function __construct()
    {
        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
    }
    //注册基础绑定
    public function registerBaseBindings()
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
        $this->singleton('log', function () {
            return (new Logger('log'))->pushHandler(new StreamHandler('php://stderr'));
        });
    }
    //注册基础服务
    public function registerBaseServiceProviders()
    {
       $this->log->debug('注册基础服务');
        $this->register(new FieldFilterServiceProvider($this));
        $this->register(new DataCacheRepositoryProvider($this));
    }

    public function register($provider)
    {
        $this->log->debug('注册provider:'.$provider::class);
        $provider->register();
        return $provider;
    }
    public function resolveProvider($provider)
    {
        return new $provider($this);
    }
}