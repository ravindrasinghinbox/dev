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
    $prev = NULL;

    while (TRUE)
    {
        if ($blue && ($prev === NULL || $prev == 0 || $prev == 2))
        {
            $blue--;
            $prev = 0;
        }
        elseif ($red && ($prev === NULL || $prev == 0 || $prev == 2))
        {
            $red--;
            $prev = 1;
        }
        elseif ($green && ($prev === NULL || $prev == 1 || $prev == 3))
        {
            $green--;
            $prev = 3;
        }
        elseif ($yellow && ($prev === NULL || $prev == 1 || $prev == 3))
        {
            $yellow--;
            $prev = 2;
        }
        else
        {
            break;
        }
        draw($prev);
    }
    return $limit - ($blue + $red + $yellow + $green);
}

/**
 * Draw val
 * @param type $val
 */
function draw($val = '')
{
    $colors = array(
        0 => 'blue',
        1 => 'red',
        2 => 'yellow',
        3 => 'green'
    );
    echo '<span style="display:inline-block;width:25px;height:25px;border-radius:50%;line-height: 24px;text-align:center;background:'.($colors[$val]=='green'?'limegreen':$colors[$val]).'">'.substr($colors[$val],0,1).'</span>';
}

