<?php

class Example {
    public static $staticVar = 10;

    public static function increment() {
        self::$staticVar++;  
        echo self::$staticVar . "\n";
    }
}

Example::increment(); 
Example::increment(); 

?>