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
//    while ($buffer = trim(fgets($fp, 4096))) {
//            $lines[] = $buffer;
//            if(count($lines) > $level) break;
//    }
        
    // Sort element
    sort($lines);
    
    // Reorder according closest
    $lineLength = count($lines);
    $map = [];
    
    for($i = 0; $i < $lineLength -1; $i++) {
        $map[$i] = NULL;
        for($j = $i+1; $j < $lineLength; $j++) {
            $scope = getScope($lines[$i], $lines[$j],$i,$j);
            if($scope !== NULL)  $map[$i] = $scope;
        }
    }

    $elems = [];
    foreach($map as $key => $value) {
        if($value)
        {
            $temp = $lines[$key];
            $lines[$key] = $lines[$value];
            $lines[$value] = $temp; 
        }
        else
        {
            $lines[] = $lines[$key];
            $elems[] = $key;
        }
    }
    
    if(is_array($elems))
    {
        
        foreach($elems as $key => $value) {
            array_splice($lines, $value,1);
        }
    }
    // Remove used weapon
    for($i = 0; $i < $weapon; $i++){
        $col = 0;
        for($j = 0; $j < $lineLength; $j++){
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
    for($i = 0; $i < $lineLength; $i++){
        $num = substr_count($lines[$i],'1');
        $coins += $num*$num;
    }
    return $coins;
}

/**
* Return percent of scope
* 
* @param type $a
* @param type $b
* @return type
*/
function getScope($a, $b,$i,$j) {
   $aCount = substr_count($a, '1');
   $bCount = substr_count($b, '1');

   if($aCount == $bCount) {
       $output = (strpos($a, '1') < strpos($b, '1'))?$i:$j;
       return $output;
   }
}