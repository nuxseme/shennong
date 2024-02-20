<?php


namespace test\domain;


use object\IDomainObject;
use object\IObject;

class Order implements IDomainObject
{

    private $clientId;
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getFilter()
    {
        return new OrderFilter($this->clientId);
    }

}