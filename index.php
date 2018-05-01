<?php

$fp = fopen('log2.txt', 'w') or die("can't open file");
fwrite($fp, '1');
fwrite($fp, '23');
fclose($fp);