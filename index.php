<pre>
    <?php
    
    $input = array("red", "green", "blue", "yellow");
array_splice($input, 1, 1);
echo '<pre>'; var_dump($input); die('</pre>');
// $input is now array("red", "yellow")
// 
//$a =['1100000', '1101000','0001001','1100001'];
//$a =['1111', '0000','0100','1001'];
//$list =['0001001', '0001101','1001001','1100000'];
//$list =['0001101', '0001111','1001001','1100001'];
    $list = ['0001001', '0001101', '1001001', '1100000'];


    sort($list);
    $len = count($list);
    $map = [];

    for($i = 0; $i < $len -1; $i++) {
        $map[$i] = NULL;
        for($j = $i+1; $j < $len; $j++) {
            $scope = getScope($list[$i], $list[$j],$i,$j);
            if($scope !== NULL)  $map[$i] = $scope;
        }
    }

    foreach($map as $key => $value) {
        if($value)
        {
            $temp = $list[$key];
            $list[$key] = $list[$value];
            $list[$value] = $temp; 
        }
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
    ?>