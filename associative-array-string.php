<?php
$student = array(
	'fname' => 'Anisur',
	'lname' => 'Rahman',
	'age' => 101
);

$serialize = serialize( $student );

$newStudent = json_encode( $serialize );
// print_r( $serialize );
print_r( $newStudent );
