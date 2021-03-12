<?php
$str = "Hello World";
$length =  strlen( $str );
echo substr( $str, $length - 3, 2);

echo PHP_EOL;

for($i = 1; $i <=$length; $i++){
	echo $str[$i*-1];
}

echo PHP_EOL;

echo strrev( $str);