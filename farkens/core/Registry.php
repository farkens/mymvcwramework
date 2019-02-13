<?php

namespace farkens\core;

/**
 * Description of Registry
 *
 * @author Farkens
 */
class Registry {
    private static $object = [];
    
    public static $instanse;


    private function __construct() {
        foreach (Farkens::$config['components'] as $name => $component){
            self::$object[$name] = new $component;
        }
        
    }
    
    public static function getInstanse() {
        if (!isset(self::$instanse)){
            self::$instanse = new self();
        }
        return self::$instanse;
    }
    
    public function __get($name) {
        if(isset(self::$object[$name])){
            return self::$object[$name];
        }
    }
    
    public function __set($name,$value) {
        if(!isset(self::$object[$name])){
            self::$object[$name] = $value;
        }
    }
    
    private function __clone() {
        
    }
    
    private function __wakeup() {
        
    }
}
