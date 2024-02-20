<?php


namespace application\middleware;

use application\handle\UniqueHandle;
use application\Payload;
use domain\value\setting\UniqueSetting;

/**
 * 数据唯一校验 中间件
 * 1 给定范围的数据
 * 2 数据批量处理
 *
 * 设置的范围条件如何与关联对象的filter查询能力一致转化为
 * 支持的条件设置与对象metadata配置的查询能力一致
 *
 * Class UniqueMiddleware
 * @package application\middleware
 */
class UniqueMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        //todo 暂不支持批量能力
        $this->container->log->debug(__METHOD__);
        foreach ($payload->data as &$row) {
            foreach ($row as $attr => &$value) {
                $attrConfig = $payload->object_config[$attr]['unique'] ?? [];
                if(!empty($attrConfig)) {
                    $uniqueHandle = new UniqueHandle(UniqueSetting::make($attrConfig),$value);
                    $uniqueHandle->process($payload->client_id,$payload->user_id);
                }
            }
        }

        return $next($payload);
    }
}