<?php

require 'tests/indexTest.php';

/**
 * Get minimum game cost
 * based on given parameter
 * 
 * @param int $level and $weapon separated by space
 * @param int nth level of element
 * @return int minimum cost for game
 */
function gameCost($levelAndWeapon, $lines) {
//    $fp = fopen ("php://stdin","r");
//    $levelAndWeapon = trim(fgets($fp));
//    
    //Extract type and weapon
    $levelAndWeapon = explode(' ',$levelAndWeapon);
    $level = $levelAndWeapon[0];
    $weapon = $levelAndWeapon[1];
    
    // Unset unuse variable
    unset($levelAndWeapon);
//    $lines = [];
//
//    while (($buffer = trim(fgets($fp, 4096))) !== false) {
//            $lines[] = $buffer;
//            if(count($lines) >= $level) break;
//    }
        
    // Sort element
    sort($lines);

    // Remove used weapon
    for($i = 0; $i < $weapon; $i++){
        $col = 0;
        for($j = 0; $j < $level; $j++){
            if(!$col){
                $col = $lines[$j][$i];
            }
            else{
                $lines[$j][$i] = 0;
            }
        }
    }
    
    // Count coins for game
    $coins = 0;
    for($i = 0; $i < $level; $i++){
        $num = substr_count($lines[$i],'1');
        $coins += $num*$num;
    }
    return $coins;
}