<?php


namespace application\middleware;


use application\Payload;

class StatisticsMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        // 当前实现 伪代码
        $this->container->log->debug(__METHOD__);

        //print_r($payload->object_config);
        //print_r($this->container->dataCacheRepository::getData());

        $statisticField = [];
        foreach ($payload->object_config as $field=>$config) {
            if($config['type'] == '统计字段') {
                $statisticField[$field] = $config;
            }
        }

        foreach ($payload->data as  &$row) {
            //对每行数据加入统计字段数据

            foreach ($statisticField as  $field=>$config) {
                $baseObjectId = $row[$config['base_object_id']];
                $targetObject = $config['target_object'];
                $targetObjectData = $this->container->dataCacheRepository::getData()[$targetObject];
                $map = [];
                foreach ($targetObjectData as  $datum) {
                    if($datum[$config['relation_id']] == $baseObjectId) {
                        $map[] = $datum;
                    }
                }
               //sum 示例
                $row[$field] = array_sum(array_column($map,$config['target_field']));
            }
        }

        return $next($payload);
    }
}