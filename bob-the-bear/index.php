<?php
require 'tests/indexTest.php';

function findMaximumFishes($input = array()){
    
    // Getting input parameter
    $size = $input['size'];
    $lens = $input['len'] = explode(' ',$input['len']);
    $times = $input['time'] = explode(' ',$input['time']);
    $timesLen = count($times);

    draw($input);

    // Variable initialization goes here
    $fishCount = 0;

    // Get unique sorted time 
    $uniqueTimes = array_unique($times);
    sort($uniqueTimes);
    $uniqueTimesLen = count($uniqueTimes);
    $fishCollection = array();
    
    for($i = 0; $i < $uniqueTimesLen; $i++){
        for($j = 0; $j < $timesLen; $j++){
            if($uniqueTimes[$i] == $times[$j]){
                // echo ($j+1).',';
                $fishCollection[$uniqueTimes[$i]][] = $j+1;
            }
            else if($uniqueTimes[$i] < $lens[$j]+$times[$j] && $uniqueTimes[$i] > $times[$j]){
                // echo ($j+1).',';
                $fishCollection[$uniqueTimes[$i]][] = $j+1;
            }
        }
    }
    return catchFishes($fishCollection);
}
function catchFishes($arr = array())
{
    $map = array();

    foreach ($arr as $key => $value) {
        $map[$key][] = count($value);

        foreach ($arr as $key1 => $value1) {
            $status = array_intersect($value,$value1);
            if(!$status){
                $map[$key][] = count($value1);
            }
        }
        rsort($map[$key]);
    }
    $maximum = 0;
    foreach ($map as $key => $value) {
        $temp = $value[0];
        if(isset($value[1]))
        {
            $temp +=$value[1];
        }
        if($temp > $maximum)
        {
            $maximum = $temp;
        }
    }
    return $maximum;
}

function draw($input = array()){
    $html = '<table  border="1" style="transform: rotateY(180deg);" cellpadding="5" cellspacing="1"><tbody>';
    for($i = 0; $i < count($input['len']); $i++)
    {
        $html .= '<tr>';
        $html = $html . str_repeat('<td> </td>',$input['time'][$i]);
        $html = $html . str_repeat('<td style="background:'.sprintf('#%06X', mt_rand(0, 0xFFFFFF)).';"> </td>',$input['len'][$i]);
        $html .= '</tr>';
    }
    $html.= '</tbody>
    </table>';
    echo $html;
}