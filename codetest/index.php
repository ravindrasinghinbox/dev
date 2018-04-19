<?php

require 'tests/index.php';

/**
 * Function will build necklace
 * based on given parameter
 * 
 * @param int $blue
 * @param int $red
 * @param int $yellow
 * @param int $green
 * @return int Number of used ruby
 */
function makeNecklace($blue, $red, $yellow, $green)
{
    $num = 0;
    $prev = null;
    $limit = 2000;
    
    for ($i = 0; $i < $limit; $i++)
    {
        if(($prev == null || $prev == 0 || $prev == 2) && $blue)
        {
            $blue--;
            $num++;
            $prev = 0;
            draw('blue');
        }
        else if(($prev == null || $prev == 2 || $prev == 0) && $red)
        {
            $red--;
            $num++;
            $prev = 1;
            draw('red');
        }
        else if(($prev == null || $prev == 1 || $prev == 3) && $green)
        {
            $green--;
            $num++;
            $prev = 3;
            draw('green');
        }
        else if(($prev == 3 || $prev == 1) && $yellow)
        {
            $yellow--;
            $num++;
            $prev = 2;
            draw('yellow');
        }
    }
    drawLine($num);
    return $num;
}

/**
 * Draw val
 * @param type $val
 */
function draw($val)
{
    echo '<span style="display:inline-block;width:25px;height:25px;border-radius:50%;line-height: 24px;text-align:center;background:'.$val.'">'.substr($val,0,1).'</span>';
}

/**
 * Function draw line
 * @param none
 * @return void 
 */
function drawLine($num)
{
    if($num) echo '<hr/>';
}