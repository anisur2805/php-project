<?php

$string = "Dhaka, Rajshahi, Bogura, Somewhere";
$stringAlt = "Dhaka, Rajshahi, Bogura,Somewhere"; // alternative string

$toArray = explode(', ', $string);
print_r($toArray);

$alterArray = preg_split('/(, |,)/', $stringAlt);
print_r( $alterArray );

$stringAgain = join(", ", $toArray);
echo $stringAgain;
