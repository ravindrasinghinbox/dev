<pre>
<?php
//$a =['1100000', '1101000','0001001','1100001'];
//$a =['1111', '0000','0100','1001'];
//$list =['0001001', '0001101','1001001','1100000'];

//$list =['0001101', '0001111','1001001','1100001'];
$list =['0001001', '0001101','1001001','1100000'];


//sort($list);
$len = count($list);
$map = [];

for($i = 0; $i < count($list); $i++)
{
    $map[$i] = 0;
    for($j = 0; $j < count($list)-1; $j++)
    {
        $scope = getScope($list[$i],$list[$j]);
        $map[$i] = $map[$i] < $scope?$scope:$map[$i];
    }
}
echo '<pre>'; var_dump($map); die('</pre>');

/**
 * Return percent of scope
 * 
 * @param type $a
 * @param type $b
 * @return type
 */
function getScope($a,$b)
{
    $aCount = substr_count($a,'1');
    $bCount = substr_count($b,'1');
    $matched = 0;
    $notMatched = 0;
    
    for($i = 0; $i < strlen($a); $i++)
    {
        if($a[$i] && $a[$i] == $b[$i])
        {
            $matched++;
        }
        else if($a[$i])
        {
            $notMatched++;
        }
    }
    return $matched;
}
?>