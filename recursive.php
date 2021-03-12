<?php

function fibonacci( $old, $new, $start, $end ) {
	if( $start > $end){
		return;
	}

	$start++;

	echo "{$old} ";
	$_temp = $old  + $new;
	$old = $new;
	$new = $_temp;

	fibonacci($old, $new, $start, $end);
}

fibonacci(0,1,1,15);
