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
    );
    
    foreach($testCase as $key => $value)
    {
        $output = call_user_func_array("makeNecklace", $value['input']);
        if($value['expect'] !== $output)
        {
            echo 'Expected: '.$value['expect'].' : '.$output.'<h5 style="color:red;">Failed case '.($key+1).': '.$value['msg'].'</h5>';
        }
    }
}
tests();