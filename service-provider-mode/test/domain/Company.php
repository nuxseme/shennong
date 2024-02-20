<?php


namespace test\domain;


use object\IDomainObject;
use object\IObject;

class Company implements IDomainObject
{

    private $clientId;
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getFilter()
    {
        return new CompanyFilter($this->clientId);
    }

}