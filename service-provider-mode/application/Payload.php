<?php

namespace application;

/**
 * 对象职责:承载运行时过程数据
 * 1 输入 待处理数据包，上下文信息，配置信息
 * 2 输出 数据包会被修改并记录最终结果
 * Class Payload
 * @package application
 */
class Payload
{
    public $client_id;
    public $user_id;

    public $origin_data;
    public $data;
    public $object_config;
    public $object;
    public $process_field;

    /**
     * @var int 可执行递归次数
     */
    private $recursion = 2;


    public function __construct($clientId,$userId,$process_field,array $data,$object)
    {
        $this->client_id = $clientId;
        $this->user_id = $userId;

        $this->process_field = $process_field;
        $this->origin_data = $this->data = $data;
        $this->object = $object;
        $this->object_config = [
            'order_id'=>[
                'type' => '主键'
            ],
            'order_no' => [
                'type'=>'serial',
                'unique' => [
                    'object' => 2,
                    'condition' => [
                        'field' => 'fieldA',
                        'operate' => '=',
                        'value' => '5'
                    ]
                ],
                'required' => [
                    'required' => true
                ]
            ],
            'product_amount_total' => [
                'type' => '统计字段',
                'base_object' => 'order',
                'base_object_id' => 'order_id',
                'relation_id' => 'order_id',
                'target_object' => 'order_product_record',
                'target_field' => 'product_amount',
                'function' => 'SUM'
            ],
            'name' => [
                'type' => 'string',
                'default_config' => [
                    'value' => '来自中间件处理的默认值'
                ]
            ],
            'tel' => [
                'type' => 'tel',
                'extend_setting' => [
                    'mask_setting' => [
                        'encrypt_code' => '*'
                    ]
                ]
            ],
            'order_company_no' => [
                'type' => 'refer',
                'refer_id' => 'company_no',
                'refer_biz_type' => 1,
                'refer_name' => '客户编号',
                'refer_field_type' => 'serial'
            ]
        ];
    }

    public function dataFields()
    {
        return array_keys($this->data[0]);
    }

    /**
     * @return int
     */
    public function getRecursion(): int
    {
        return $this->recursion;
    }

    /**
     * @param int $recursion
     */
    public function setRecursion(int $recursion): void
    {
        $this->recursion = $recursion;
    }
}