<?php


namespace application\middleware;

use application\Payload;

class DefaultMiddleware extends Middleware
{
    public function handle(Payload $payload, \Closure $next)
    {
        $this->container->log->debug(__METHOD__);

        foreach ($payload->data as &$row) {
            foreach ($row as $attr => &$value) {
                $attrConfig = $payload->objectConfig[$attr]['default_config'] ?? [];
                 if(!empty($attrConfig)) {
                     $value = $attrConfig['value'];
                 }
            }
        }
        return $next($payload);
    }
}