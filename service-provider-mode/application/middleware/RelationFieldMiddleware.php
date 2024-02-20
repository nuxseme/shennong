<?php
namespace application\middleware;

use application\Payload;
use object\ObjectFactory;
use object\order\OrderContext;

/**
 * 关联字段处理
 * Class RelationFieldMiddleware
 * @package application\middleware
 */
class RelationFieldMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        $this->container->log->debug(__METHOD__.'recursion'.$payload->getRecursion());

        if(!$payload->getRecursion()) {
            return $payload;
        }

        $relationFieldMap = [];

        foreach ($payload->object_config as $field => $config) {
            if($config['type'] == 'refer' &&  in_array($field,$payload->process_field)) {
                $relationFieldMap[$config['refer_biz_type']][] = [
                    'field' => $config['refer_id'],
                    'origin_field' => $field,
                ];
            }
        }


        foreach ($relationFieldMap as  $object => $item) {

            $orderContext = new  OrderContext();
            $orderContext->relations();
            $relationId = $orderContext->getRelation('company')->getTargetRelationId();

            $relationIdMap = array_column($payload->data,$relationId,$relationId);
            $domainInstance = ObjectFactory::create($object,$payload->client_id);
            $filter = $domainInstance->getFilter();
            $filter->select(array_column($item,'field'));
            $data = $filter->setQuery([
                'company_id' => $relationIdMap
            ])->find();

            $data = array_column($data,null,$relationId);
            //数据回填
            foreach ($payload->data as &$row) {
                $row['relation_object']['company'] = $data[$row[$relationId]] ?? [];
            }

        }

//        $middlewares = [
//            RelationFieldMiddleware::class,
//        ];
//        $payload = (new Pipeline($this->container))
//            ->send($payload)
//            ->through($middlewares)
//            ->then(function ($payload){
//                return  $payload;
//            });

        return $next($payload);
    }

}