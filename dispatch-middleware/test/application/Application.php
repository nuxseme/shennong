<?php
namespace test\application;

use PHPUnit\Framework\TestCase;

class Application  extends TestCase
{
    public function testRun()
    {
        $application = new \application\Application();
        $application->run();
    }
}