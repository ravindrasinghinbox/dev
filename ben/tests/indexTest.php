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
                "input" => [1, 1, 1, 1],
                "expect" => 4,
                "msg" => "Should work with 1 blue, 1 red, 1 yellow and 1 green"
            ),
            array(
                "input" => [5, 3, 0, 0],
                "expect" => 6,
                "msg" => "Should work with 5 blue, 3 red, 0 yellow and 0 green"
            ),
            array(
                "input" => [5, 3, 1, 0],
                "expect" => 8,
                "msg" => "Should work with 5 blue, 3 red, 1 yellow and 0 green"
            ),
            array(
                "input" => [0, 5, 0, 0],
                "expect" => 1,
                "msg" => "Should work with 0 blue, 5 red, 0 yellow and 0 green"
            ),
            array(
                "input" => [0, 0, 5, 0],
                "expect" => 1,
                "msg" => "Should work with 0 blue, 0 red, 5 yellow and 0 green"
            ),
            array(
                "input" => [0, 0, 0, 5],
                "expect" => 5,
                "msg" => "Should work with 0 blue, 0 red, 0 yellow and 5 green"
            ),
            array(
                "input" => [1, 1, 1, 0],
                "expect" => 3,
                "msg" => "Should work with 1 blue, 1 red, 1 yellow and 0 green"
            ),
            array(
                "input" => [1, 1, 1, 1],
                "expect" => 4,
                "msg" => "Should work with 1 blue, 1 red, 1 yellow, and 1 green"
            ),
            array(
                "input" => [989, 147, 0, 0],
                "expect" => 990,
                "msg" => "Should work with 989 blue, 147 red,  0 yellow, and 0 green"
            ),
            array(
                "input" => [0, 10, 0, 0],
                "expect" => 1,
                "msg" => "Should work with 0 blue, 10 red,  0 yellow, and 0 green"
            ),
            array(
                "input" => [5, 0, 0, 0],
                "expect" => 5,
                "msg" => "Should work with 5 blue, 0 red,  0 yellow, and 0 green"
            ),
            array(
                "input" => [0, 0, 5, 0],
                "expect" => 1,
                "msg" => "Should work with 0 blue, 0 red,  5 yellow, and 0 green"
            ),
            array(
                "input" => [0, 0, 0, 5],
                "expect" => 5,
                "msg" => "Should work with 0 blue, 0 red,  0 yellow, and 5 green"
            ),
            array(
                "input" => [3, 4, 2, 1],
                "expect" => 9,
                "msg" => "Should work with 3 blue, 4 red,  2 yellow, and 1 green"
            ),
            array(
                "input" => [0, 0, 0, 0],
                "expect" => 0,
                "msg" => "Should work with 0 blue, 0 red,  0 yellow, and 0 green"
            ),
            array(
                "input" => [1, 1, 5, 5],
                "expect" => 8,
                "msg" => "Should work with 1 blue, 1 red,  5 yellow, and 5 green"
            ),
            array(
                "input" => [5, 0, 5, 5],
                "expect" => 5,
                "msg" => "Should work with 5 blue, 0 red,  5 yellow, and 5 green"
            ),
            array(
                "input" => [0, 0, 5, 5],
                "expect" => 6,
                "msg" => "Should work with 0 blue, 0 red,  5 yellow, and 5 green"
            ),
            array(
                "input" => [5, 0, 0, 5],
                "expect" => 5,
                "msg" => "Should work with 5 blue, 0 red,  0 yellow, and 5 green"
            ),
            array(
                "input" => [0, 2000, 2000, 2000],
                "expect" => 6000,
                "msg" => "Should work with 0 blue, 2000 red, 2000 yellow and 2000 green"
            ),
            array(
                "input" => [100, 20, 0, 20],
                "expect" => 121,
                "msg" => "Should work with 100 blue, 20 red, 0 yellow and 20 green"
            ),
        );
    }

    public function run()
    {
        foreach ($this->testCase as $key => $value)
        {
            parent::__construct();
            $value['output'] = call_user_func_array("makeNecklace", $value['input']);
            $value['id'] = $key + 1;
            $this->report($value);
        }
    }

}

$test = new Test();
$test->run();
