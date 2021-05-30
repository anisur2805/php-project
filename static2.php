<?php
class Example {
	private static $a = "Hello";
	private static $b;
	
	public static function init(){
		return self::$b = self::$a . " World";
	} 
}

echo Example::init();