<?php


namespace application\middleware;

use application\handle\MaskHandle;
use application\Payload;
use domain\value\setting\MaskSetting;

class MaskMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        $this->container->log->debug(__METHOD__);

        foreach ($payload->data as &$row) {
            foreach ($row as $attr => &$value) {
                $attrConfig = $payload->object_config[$attr]['extend_setting']['mask_setting'] ?? [];
                if(!empty($attrConfig)) {
                    $maskHandle = new MaskHandle(MaskSetting::make($attrConfig),$value);
                    $value = $maskHandle->process();
                }
            }
        }

        return $next($payload);
    }

}