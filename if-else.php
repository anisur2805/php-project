<?php

$year = 2001;
if($year % 4 == 0 && $year % 100 == 0 && $year % 400 == 0) {
	echo "$year is a leap year";
} else {
	echo "$year is not a leap year";
}


// alternate if else
echo "\n";

if($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0 )){
	echo "$year is a leap year";
} else {
	echo "$year is not a leap year";
}
