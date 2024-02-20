<?php
namespace application\context;

use application\middleware\DefaultMiddleware;
use application\middleware\PrivilegeMiddleware;
use application\middleware\RequiredMiddleware;
use application\middleware\UniqueMiddleware;

class WriteContext extends Context
{
    /**
     * 输入 数据处理中间件  遵循如下顺序
     * . 数据鉴权
     * . 数据默认值
     * . 数据唯一性
     * @var array
     */
    protected $middlewares = [
        UniqueMiddleware::class,
        DefaultMiddleware::class,
        RequiredMiddleware::class,
        PrivilegeMiddleware::class,
    ];

}