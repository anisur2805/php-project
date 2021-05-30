<?php
use DesignPatternExample\MediaFactory;
include_once "dp1.php";

$audio = MediaFactory::factory( "audio" );
var_dump( $audio );

$video = MediaFactory::factory( 'video' );
// var_dump( $video );

$photo = MediaFactory::factory( 'photo' );
// var_dump( $photo );

// echo "Hello world";
