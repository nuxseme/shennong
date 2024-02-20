<?php

namespace test\domain;


class CompanyFilter
{

    private $clientId;
    private $query = [];
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function select($fields = [])
    {
        return $this;
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
                'company_id' => 100,
                'user_id' => 1,
                'name' => 'test_company_id',
                'company_no'=> 'company_no_1'
            ]
        ];
    }

    public function count()
    {
        return 1;
    }
}