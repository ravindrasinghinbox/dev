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
    $fishCollectionCount = array();
    foreach ($fishCollection as $key => $value) {
        
        $fishCollectionCount[$key] = count($value);
        foreach ($fishCollection as $key1 => $value1) {

            $intersect = array_intersect($value,$value1);
            if(empty($intersect))
            {
                $matchCount = count($value)+count($value1);
                if($fishCollectionCount[$key] < $matchCount)
                {
                    $fishCollectionCount[$key] = $matchCount;
                }
            }
        }
    }
    return max($fishCollectionCount);
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