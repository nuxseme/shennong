<?php

namespace application\handle;


use domain\exception\UniqueException;
use domain\value\setting\UniqueSetting;
use object\ObjectFactory;

/**
 * 唯一校验
 *
 * Class UniqueHandle
 * @package domain\handle
 */
class UniqueHandle
{
    private $value;
    private UniqueSetting $uniqueSetting;
    public function __construct(
        UniqueSetting $uniqueSetting,
        $value = null,
    ){
        $this->uniqueSetting = $uniqueSetting;
        $this->value = $value;
    }

    public function process($clientId,$userId)
    {
        $object = $this->uniqueSetting->getObject();

        $domainInstance = ObjectFactory::create($object,$clientId);

        $filter = $domainInstance->getFilter();

        $count = $filter->setQuery($this->uniqueSetting->getQuery())->count();
        if($count > 1) {
            throw new UniqueException('当前数据在指定范围不唯一');
        }
    }
}