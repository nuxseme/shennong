<?php
namespace application;
use Illuminate\Pipeline\Pipeline;

class Application
{
    public function run()
    {
        $pass = 'send-pass';
        $middleware = [
            function($pass,\Closure $next){
                echo 'middleware1'.$pass,PHP_EOL;
                return $next($pass);
            },
            function($pass,\Closure $next){
                echo 'middleware2'.$pass,PHP_EOL;
                return $next($pass);
            },
        ];
        return (new Pipeline())
            ->send($pass)
            ->through($middleware)
            ->then(function ($pass){
                echo 'end',PHP_EOL;
                return  $pass;
            });

    }
}