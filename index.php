<?php
$handle = fopen ("php://stdin","r");
$levelAndWeapon = trim(fgets($handle));

$levelAndWeapon = explode(' ',$levelAndWeapon);
$level = $levelAndWeapon[0];
$weapon = $levelAndWeapon[1];
$lines = [];

while (($buffer = trim(fgets($handle, 4096))) !== false) {
	$lines[] = $buffer;
	if(count($lines) >= $level) break;
}