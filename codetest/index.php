<?php

require 'tests/indexTest.php';

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
function makeNecklace($blue = 0, $red = 0, $yellow = 0, $green = 0)
{
    $limit = $blue + $red + $yellow + $green;
    $count = 0;
    $prev = NULL;

    for ($i = 0; $i <= $limit; $i++)
    {
        $index = $i % 4;
        if (($prev === NULL && $blue) || ($prev == 0 && $blue) || ($prev == 2 && $blue))
        {
            $blue--;
            draw('blue');
            $prev = 0;
        }
        elseif (($prev === NULL && $red) || ($prev == 0 && $red) || ($prev == 2 && $red))
        {
            $red--;
            draw('red');
            $prev = 1;
        }
        elseif (($prev === NULL && $green) || ($prev == 1 && $green) || ($prev == 3 && $green))
        {
            $green--;
            draw('green');
            $prev = 3;
        }
        elseif (($prev === NULL && $yellow) || ($prev == 1 && $yellow) || ($prev == 3 && $yellow))
        {
            $yellow--;
            draw('yellow');
            $prev = 2;
        }
    }
    return $limit - ($blue + $red + $yellow + $green);
}

/**
 * Draw val
 * @param type $val
 */
function draw($val = '')
{
    echo '<span style="display:inline-block;width:25px;height:25px;border-radius:50%;line-height: 24px;text-align:center;background:'.($val=='green'?'limegreen':$val).'">'.substr($val,0,1).'</span>';
}

