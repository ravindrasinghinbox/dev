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
                "expect" => 5,
                "msg" => "Should catch 3 at time = 9 and 2 at time = 7"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '1 1 1 5 2 1 1 1 1 5',
                    'time' => '1 2 3 4 5 6 7 8 8 10'
                ],
                "expect" => 6,
                "msg" => "Should catch 4 at time = 7 and 2 at time = 8"
            ),
            array(
                "input" => [
                    'size' => '10',
                    'len' => '1 1 1 5 2 1 1 1 1 5',
                    'time' => '0 1 0 0 0 0 0 0 0 0'
                ],
                "expect" => 10,
                "msg" => "Should catch 10 at time = 2"
            ),
            array(
                "input" => [
                    'size' => '3',
                    'len' => '5 5 5',
                    'time' => '5 10 15'
                ],
                "expect" => 3,
                "msg" => "Should catch 2 at time = 10 and 1 at time = 14"
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
            array(
                "input" => [
                    'size' => '13',
                    'len' => '1 1 1 1 1 1 1 1 1 2 4 5 9',
                    'time' => '3 5 5 6 7 7 9 9 9 6 2 4 1'
                ],
                "expect" => 10,
                "msg" => "Should catch 7 salmons at time T=6. Then catch 3 salmons at time T=9"
            ),
            array(
                "input" => [
                    'size' => '15',
                    'len' => '2 2 10 1 1 1 1 1 1 3 3 3 3 3 3',
                    'time' => '1 1 1 3 5 5 5 5 5 7 7 7 7 7 7'
                ],
                "expect" => 12,
                "msg" => "Should catch 6 salmons at time T=6. Then catch 6 salmons at time T=8"
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
