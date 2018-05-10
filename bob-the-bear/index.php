<?php
require 'tests/indexTest.php';

function cacheMaximumFishes($input = array()){

    // Getting input parameter
    $size = $input['size'];
    $len = $input['len'];
    $time = $input['time'];

    // Variable initialization goes here
    $fishCount = 0;


    var_dump('before: ',$time);
    $time = getUniqueTime($time);
    var_dump('after: ',$time);
}

function getUniqueTime(){
    
    $arr = array_unique($arr);
}