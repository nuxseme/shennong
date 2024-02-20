<?php


namespace application\context;

use application\Application;
use application\Payload;
use Illuminate\Pipeline\Pipeline;

/**
 * 定义使用场景 处理业务相关流程
 * 依赖application,定义场景执行流程
 * Class Context
 * @package application\context
 */
abstract class Context
{
    /**
     * 中间件 按序处理
     * @var array
     */
    protected $middlewares = [

    ];

    protected Application $app;

    public  function run(Payload $payload)
    {
        $application = new Application();
        $application->instance('context',$this);

        $this->app = $application;
        $application->log->debug("clientId:$payload->client_id,user_id,$payload->user_id");
       // $application->log->debug('todo 字段配置解析到缓存');
       // $application->log->debug('todo 关联字段值解析到缓存');
        return (new Pipeline($application))
            ->send($payload)
            ->through($this->middlewares)
            ->then(function ($payload){
                return  $payload;
            });
    }
}