<?php

$person = array(
	'fname' => 'Hello',
	'lname' => 'World'
);

$newperson = &$person;
$newperson['lname'] = 'Pluto';

print_r( $person );
print_r( $newperson );
