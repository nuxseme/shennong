<?php
namespace test\application;


use application\context\ReadContext;
use application\context\WriteContext;
use application\Payload;
use PHPUnit\Framework\TestCase;

class Application  extends TestCase
{
    public function testConstruct()
    {
        $application = new \application\Application();
        print_r($application);
    }

    public function testMake()
    {
        $application = new \application\Application();
        $instance = $application->make('a');
        print_r($instance);
    }

    public function testRunWriteContext()
    {
        $payload = new Payload(14119,11858713,[
            'order_id',
            'name',
            'product_total_amount',
            'tel',
        ],[
            [
                'order_id'=>1,
                'name' => 'order_name1',
                'tel'=> '1580001066',
                'order_no' => '980'
            ]
        ],1);
        (new WriteContext())->run($payload);

        print_r($payload->data);
    }

    public function testRunReadContext()
    {
        $payload = new Payload(14119,11858713,[
            'order_id',
            'name',
            'product_total_amount',
            'tel',
            'order_company_no'
        ],[
            [
                'order_id'=>1,
                'name' => 'order_name1',
                'tel'=> '1580001066',
                'order_no' => '980',
                'company_id' => 100,
            ]
        ],1);
        (new ReadContext())->run($payload);

        print_r($payload->data);

    }
}