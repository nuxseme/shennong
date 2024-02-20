<?php

namespace test\domain;


class OrderFilter
{

    private $clientId;
    private $query = [];
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }


    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    public function find()
    {
        //根据设置的query 返回查询器
        return [
            [
                'order_id' => 100,
                'user_id' => 1,
                'name' => 'test1',
            ]
        ];
    }

    public function count()
    {
        return 1;
    }
}