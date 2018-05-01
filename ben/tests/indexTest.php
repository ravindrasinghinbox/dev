<?php
require 'Summary.php';

class Test extends Summary
{
    var $testCase;

    function __construct()
    {
        parent::__construct();
        
        $this->testCase = array(
//            array(
//                "input" => [
//                    'levelAndWeapon' => '3 3',
//                    'lines' => ['111', '001', '010']
//                ],
//                "expect" => 3,
//                "msg" => "Should work with 3 level and 3 type of weapon"
//            ),
//            array(
//                "input" => [
//                    'levelAndWeapon' => '1 4',
//                    'lines' => ['0101']
//                ],
//                "expect" => 4,
//                "msg" => "Should work with 1 level and 2 type of weapon"
//            ),
//            array(
//                "input" => [
//                    'levelAndWeapon' => '3 6',
//                    'lines' => ['010101','010101','010101']
//                ],
//                "expect" => 9,
//                "msg" => "Should work with 3 level and 6 type of weapon"
//            ),
//            array(
//                "input" => [
//                    'levelAndWeapon' => '3 6',
//                    'lines' => ['010101','010001','010101']
//                ],
//                "expect" => 5,
//                "msg" => "Should work with 3 level and 6 type of weapon"
//            ),
//            array(
//                "input" => [
//                    'levelAndWeapon' => '1 2',
//                    'lines' => ['01','11']
//                ],
//                "expect" => 2,
//                "msg" => "Should work with 1 level and 2 type of weapon"
//            ),
//            array(
//                "input" => [
//                    'levelAndWeapon' => '3 3',
//                    'lines' => ['111', '110', '100','101','011','110','010','001','011','101']
//                ],
//                "expect" => 3,
//                "msg" => "Should work with 1 level and 1 type of weapon"
//            ),
            array(
                "input" => [
                    'levelAndWeapon' => '1 4',
                    'lines' => ['1111', '0010','0010','1001']
                ],
                "expect" => 6,
                "msg" => "Should work with 1 level and 1 type of weapon"
            ),
        );
    }

    public function run()
    {
    /*$weapon = 20;
    $level = 20;
    $i = 0;
    $t =  bindec(str_repeat(1,$weapon));
    //echo decbin($t).'<br/>';
    $tests = [];
    while($level > $i)
    {
            $binary = decbin(rand(0,$t));
            $tests[]  = sprintf('%0'.($weapon).'s', $binary);
            $i++;
    }
    sort($tests);*/
        foreach ($this->testCase as $key => $value)
        {
            $this->test();
            $value['output'] = call_user_func("gameCost",$value['input']['levelAndWeapon'],$value['input']['lines']);
            $value['id'] = $key + 1;
            $this->report($value,true);
        }
    }

}

$test = new Test();
$test->run();
