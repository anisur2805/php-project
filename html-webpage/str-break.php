<?php
$string = "The Quick brown fox jumps over the lazy dog";
$exp = explode(" ", $string);
print_r( $exp );

$imp = implode(" ", $exp );
print_r( $imp  );

$parts = strtok($string, " ,");
while($parts !== false ){
	echo $parts . "\n";
	$parts = strtok(" ,");
}


echo PHP_EOL;

$parts2 = preg_split("/ |,/", $string);
print_r( $parts2 );
