<?php
require 'tests/indexTest.php';

function cacheMaximumFishes($input = array()){

    // Getting input parameter
    $size = $input['size'];
    $lens = explode(' ',$input['len']);
    $times = explode(' ',$input['time']);
    $timesLen = count($times);

    // Variable initialization goes here
    $fishCount = 0;

    // Get unique sorted time 
    $uniqueTimes = array_unique($times);
    sort($uniqueTimes);
    $uniqueTimesLen = count($uniqueTimes);
    
    for($i = 0; $i < $uniqueTimesLen; $i++){
        for($j = 0; $j < $timesLen; $j++){
            if($uniqueTimes[$i] == $times[$j]){
                echo ($j+1).',';
            }
            else if($uniqueTimes[$i] < $lens[$j]+$times[$j] && $uniqueTimes[$i] > $times[$j]){
                echo ($j+1).',';
            }
        }
        echo '<br/>';
    }
}