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
                    'levelAndWeapon' => '3 3',
                    'lines' => ['111', '001', '010']
                ],
                "expect" => 3,
                "msg" => "Should work with 3 level and 3 type of weapon"
            ),
            array(
                "input" => [
                    'levelAndWeapon' => '1 4',
                    'lines' => ['0101']
                ],
                "expect" => 4,
                "msg" => "Should work with 1 level and 2 type of weapon"
            ),
            array(
                "input" => [
                    'levelAndWeapon' => '4 7',
                    'lines' => ['1100000', '1101000','0001001','1100001']
                ],
                "expect" => 6,
                "msg" => "Should work with 4 level and 7 type of weapon"
            ),
            array(
                "input" => [
                    'levelAndWeapon' => '4 4',
                    'lines' => ['1111', '0000','0100','1001']
                ],
                "expect" => 6,
                "msg" => "Should work with 4 level and 4 type of weapon"
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
