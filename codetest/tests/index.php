<?php

function tests()
{
    $testCase = array(
        array(
            "input" => [1,1,1,0],
            "expect" => 3,
            "msg" => "Should work with 1 blue, 1 red, 1 yellow and 0 green"
        ),
        array(
            "input" => [1,1,1,1],
            "expect" => 4,
            "msg" => "Should work with 1 blue, 1 red, 1 yellow, and 1 green"
        ),
        array(
            "input" => [989,147,0,0],
            "expect" => 990,
            "msg" => "Should work with 989 blue, 147 red,  0 yellow, and 0 green"
        ),
        array(
            "input" => [0,10,0,0],
            "expect" => 1,
            "msg" => "Should work with 0 blue, 10 red,  0 yellow, and 0 green"
        ),
        array(
            "input" => [5,0,0,0],
            "expect" => 5,
            "msg" => "Should work with 5 blue, 0 red,  0 yellow, and 0 green"
        ),
        array(
            "input" => [0,0,5,0],
            "expect" => 0,
            "msg" => "Should work with 0 blue, 0 red,  5 yellow, and 0 green"
        ),
        array(
            "input" => [3,4,2,1],
            "expect" => 9,
            "msg" => "Should work with 3 blue, 4 red,  2 yellow, and 1 green"
        ),
        array(
            "input" => [0,0,0,10],
            "expect" => 10,
            "msg" => "Should work with 0 blue, 0 red,  0 yellow, and 10 green"
        ),
    );
    
    $totalTest = 0;
    $passed = 0;
    foreach($testCase as $key => $value)
    {
        $totalTest++;
        $output = call_user_func_array("makeNecklace", $value['input']);
        if($value['expect'] !== $output)
        {
            echo 'Expected: '.$value['expect'].' : '.$output.'<pre style="color:red;">Failed case '.($key+1).': '.$value['msg'].'</pre>';
        }
        else
        {
            $passed++;
        }
    }
    echo '<hr/><pre>Passed ('.$passed.'/'.$totalTest.') = '.number_format($passed*100/$totalTest,2).'%</pre>';
}
tests();