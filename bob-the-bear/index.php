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
            if($uniqueTimes[$i] == $times[$j] 
            || ($uniqueTimes[$i] < $lens[$j]+$times[$j] && $uniqueTimes[$i] > $times[$j])){
                
                $fishCollection[$uniqueTimes[$i]][] = $j+1;
            }
        }
    }
    $fishCollectionMap = array();
    foreach ($fishCollection as $key => $value) {
        $fishCollectionMap[count($value)] = $value;
    }

    $fishCollectionMapUnique = array();
    foreach ($fishCollectionMap as $key => $value) {
        $status = array();
        foreach ($fishCollectionMap as $key1 => $value1) {
            
            if($key != $key1 && count($value) <= count($value1)){
                $status = array_intersect($value,$value1);
            }
        }
        if(!count($status)){
            $fishCollectionMapUnique[$key] = count($value);
        }
        else{
            $fishCollectionMap[$key] = array();
        }
    }
    return catchFishes($fishCollectionMapUnique);
}
function catchFishes($arr = array())
{
    $map = $arr;
    rsort($map);
    $maximum = 0;
    for($i = 0; $i < count($map); $i++){
        if($i < 2){
            $maximum += $map[$i];
        }
    }
    return $maximum;
}

function draw($input = array()){
    
    $html = '<div style="overflow:auto"><table  border="1" style="transform: rotateY(180deg);" cellpadding="5" cellspacing="1"><tbody>';
    for($i = 0; $i < count($input['len']); $i++)
    {
        $html .= '<tr>';
        $html = $html . str_repeat('<td> </td>',$input['time'][$i]);
        $html = $html . str_repeat('<td style="background:'.sprintf('#%06X', mt_rand(0, 0xFFFFFF)).';"> </td>',$input['len'][$i]);
        $html .= '</tr>';
    }
    $html.= '</tbody>
    </table></div>';
    echo $html;
}