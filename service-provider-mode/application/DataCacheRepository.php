<?php


namespace application;

/**
 * 数据缓存仓库
 * 1 批量获取关联对象字段值
 * 2 单进程缓存
 * Class DataCacheRepository
 * @package application
 */
class DataCacheRepository
{

    public static function getData()
    {
        return [
            'order' => [
                [
                    'order_id' => 1,
                    'name' => '订单1'
                ],
                [
                    'order_id' => 2,
                    'name' => '订单2'
                ],
            ],
            'order_product_record' => [
                [
                    'order_id'=>1,
                    'product_record_id'=>11,
                    'product_amount'=>10
                ],
                [
                    'order_id'=>1,
                    'product_record_id'=>12,
                    'product_amount'=>20
                ]
            ]
        ];
    }
}