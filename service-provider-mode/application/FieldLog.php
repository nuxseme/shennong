<?php


namespace application;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FieldLog
{
    static $log;

    private static function init()
    {
        if(is_null(static::$log)) {
            static::$log = (new Logger('xm_field'))->pushHandler(new StreamHandler('php://stderr'));
        }
    }

    public static function debug($message)
    {
        static::init();
        static::$log->debug($message);
    }

}