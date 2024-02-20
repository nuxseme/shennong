<?php


namespace application\middleware;

use application\context\WriteContext;
use application\handle\PrivilegeHandle;
use application\Payload;
use domain\FieldPrivilegeFilter;
use domain\FieldSettingConstants;

class PrivilegeMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        $this->container->log->debug(__METHOD__);

        print_r($payload->dataFields());

        $privilegeConfig =  (new FieldPrivilegeFilter())->find();

        $privilegeHandle = new PrivilegeHandle(
            $payload->dataFields(),
            $privilegeConfig,
            FieldSettingConstants::NO_PRIVILEGE_THROW_EXCEPTION
        );

        $payload->data = $this->container->get('context') instanceof WriteContext ? $privilegeHandle->writeProcess($payload->data) : $privilegeHandle->readProcess($payload->data);

        return $next($payload);
    }

}