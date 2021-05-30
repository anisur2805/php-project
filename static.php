<?php 
class Foo {
    public static $my_static = "foo\n";
    
    public static function staticValue( ) {
        return self::$my_static;
    }
}


class Bar extends Foo {
    public function fooStatic(){
        return parent::$my_static;
    }
}

// print Foo::$my_static;

// $foo = new Foo();
// print $foo->staticValue();
// // print $foo->$my_static;
// print $foo::$my_static;


$classname = "Foo";
// print $classname::$my_static;


class A {
    static protected $test = "Class A\n";
    
    public function static_test() {
        echo static::$test;
        echo self::$test;
        
    }
}

class B extends A {
    static protected $test = "Class B\n";
    
     public function static_test2() {
        echo parent::$test;
     } 
}

// $obj = new B();
// $obj->static_test();
// $obj->static_test2();

class FooClass {
    public static $bar = "A static property";
}

$fc = (new FooClass)::$bar;
// echo $fc;


class AA {
    public static function aStaticMethod() {
        echo "hello";
    }
}

$cn = "AA";
$methodName = "aStaticMethod";
$cn::{$methodName}();



try {
    $method = new ReflectionMethod('Foo::staticValud');

    if( $method->isStatic()) {
        echo $method . " is static\n";
    }
} catch ( ReflectionException $ea ) {
    echo $ea->getMessage();
}
