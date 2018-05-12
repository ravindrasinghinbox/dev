<?php
require 'Summary.php';

class Test extends Summary
{
    var $testCase;

    function __construct()
    {
        parent::__construct();
        
        $this->testCase = array(
            array(
                "input" => [
                    'size' => '5',
                    'len' => '2 4 4 2 4',
                    'time' => '1 4 1 6 4'
                ],
                "expect" => 5,
                "msg" => "Should catch 1 and 3 at time = 2 and will catch 2, 4 and 5 at time = 7"
            ),
            array(
                "input" => [
                    'size' => '1',
                    'len' => '1',
                    'time' => '2'
                ],
                "expect" => 1,
                "msg" => "Should catch 1 at time = 3"
            ),
            array(
                "input" => [
                    'size' => '5',
                    'len' => '2 4 4 2 4',
                    'time' => '1 2 1 6 4'
                ],
                "expect" => 5,
                "msg" => "Should catch 1 and 3 at time = 2 and will catch 2, 4 and 5 at time = 7"
            ),
        );
    }

    public function run()
    {
        foreach ($this->testCase as $key => $value)
        {
            $this->test();
            $value['output'] = call_user_func("findMaximumFishes",$value['input']);
            $value['id'] = $key + 1;
            $this->report($value,true);
        }
    }

}

$test = new Test();
$test->run();
