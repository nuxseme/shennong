<?php


namespace application\services;


class FieldService
{
    private $object;
    private $fields;

    private $levelLimit = 2;

    private $clientId;
    private $userId;

    /**
     * @param $clientId
     * @param $userId
     *
     */
    public function __construct()
    {
//        $this->clientId = $clientId;
//        $this->userId = $userId;
    }


    public function getAllRelationObjectAndField()
    {
        return [
            'order' => [
                'name',
                'order_id',
                'field1',
            ],
            'order_product_record' => [
                'product_record_id',
                'order_id',
                'product_amount',
                'product_count'
            ]
        ];
    }
}