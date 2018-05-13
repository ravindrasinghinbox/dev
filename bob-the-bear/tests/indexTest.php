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
                "msg" => "Should catch 1, 2 and 3 at time = 3 and 4 and 5 at time = 4"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '1 1 1 5 1 1 1 1 1 5',
                    'time' => '1 2 3 4 5 6 7 8 9 10'
                ],
                "expect" => 3,
                "msg" => "Should catch 2 at time = 6 and 1 at anytime"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '1 1 1 5 2 1 1 1 1 5',
                    'time' => '1 2 3 4 5 6 7 8 8 10'
                ],
                "expect" => 4,
                "msg" => "Should catch 3 at time = 9 and 1 at anytime"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '1 1 1 5 2 1 1 1 1 5',
                    'time' => '0 1 0 0 0 0 0 0 0 0'
                ],
                "expect" => 9,
                "msg" => "Should catch 3 at time = 9 and 1 at anytime"
            ),
            array(
                "input" => [
                    'size' => '3',
                    'len' => '5 5 5',
                    'time' => '5 10 15'
                ],
                "expect" => 2,
                "msg" => "Should catch 3 at time = 9 and 1 at anytime"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '5 5 5 7 5 6 5 5 5 5',
                    'time' => '0 0 0 4 10 5 0 0 0 0'
                ],
                "expect" => 10,
                "msg" => "Should catch 1,2,3 and 7,8,9,10 at time = 1 and 4,5,6 at time = 11"
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
