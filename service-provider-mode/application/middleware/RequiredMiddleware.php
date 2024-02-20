<?php
namespace application\middleware;

use application\handle\RequiredHandle;
use application\Payload;
use domain\value\setting\RequiredSetting;

class RequiredMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        $this->container->log->debug(__METHOD__);
        // TODO: Implement handle() method.
        //throw new \Exception('必填字段未设置值');
        foreach ($payload->data as &$row) {
            foreach ($row as $attr => &$value) {
                $attrConfig = $payload->object_config[$attr]['required'] ?? [];
                if(!empty($attrConfig)) {
                    $requiredHandle = new RequiredHandle(RequiredSetting::make($attrConfig),$value);
                    $requiredHandle->process($payload->client_id,$payload->user_id);
                }
            }
        }
        return $next($payload);
    }

}