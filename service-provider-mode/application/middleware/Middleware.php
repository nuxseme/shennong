<?php

namespace application\middleware;

use application\Payload;
use Illuminate\Container\Container;

abstract class Middleware
{
    /**
     * @var Container $container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    abstract public function handle(Payload $payload,\Closure $next);
}