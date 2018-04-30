<?php

//require 'tests/indexTest.php';

/**
 * Get minimum game cost
 * based on given parameter
 * 
 * @param int $level and $weapon separated by space
 * @param int nth level of element
 * @return int minimum cost for game
 */
function gameCost($levelAndWeapon, $lines = array()) {
//    $handle = fopen ("php://stdin","r");
//    $levelAndWeapon = trim(fgets($handle));
//    
//    //Extract type and weapon
//    $levelAndWeapon = explode(' ',$levelAndWeapon);
//    $level = $levelAndWeapon[0];
//    $weapon = $levelAndWeapon[1];
//    
//    // Unset unuse variable
//    unset($levelAndWeapon);
//    $lines = [];
//
//    while (($buffer = trim(fgets($handle, 4096))) !== false) {
//            $lines[] = $buffer;
//            if(count($lines) >= $level) break;
//    }
        
    // Sort element
    sort($lines);
    
    // Count minumum coins
    $coins = 0;
    foreach ($lines as $key => $value) {
        $num = substr_count($value, '1');
        $coins += $coins?$num:($num*$num);
        if ($coins + $num > $level)
            break;
    }
    echo $coins;
}

$lines = ['111', '101', '010']; $levelAndWeapon = '3 3';
//$lines = ['0101'];  $levelAndWeapon = '1 4';
echo '<pre>';
gameCost($levelAndWeapon, $lines);
