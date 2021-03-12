<?php

function recursive( $number ){
	echo "$number ";

	if($number < 10) {
		return recursive( $number + 1);
	}
}

$startNumber = 1;
// recursive( $startNumber ) . PHP_EOL;

function factorial( $n ) {
	if( $n <= 1) {
		return 1;
	}

	return $n * factorial( $n - 1);
}

echo factorial(5);

