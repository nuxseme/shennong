<?php

namespace application\context;

use application\middleware\MaskMiddleware;
use application\middleware\PrivilegeMiddleware;
use application\middleware\RelationFieldMiddleware;
use application\middleware\StatisticsMiddleware;

class ReadContext extends Context
{
    /**
     * 输出场景 数据处理中间件  遵循如下顺序
     * 数据补充
     * 数据鉴权
     * 数据加密
     * 数据掩码
     * @var array
     */
    protected $middlewares = [
        StatisticsMiddleware::class,
        //PrivilegeMiddleware::class,
        RelationFieldMiddleware::class,
        MaskMiddleware::class,
    ];

}