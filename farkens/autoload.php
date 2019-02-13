<?php

spl_autoload_register(function($className){
    $dir = ROOT . DS . str_replace('\\', DS , $className) . '.php';
    if(is_file($dir)){
        require_once $dir;
        //print_r($dir . '<br/>');
    }else{
       // print_r('не существует' . $dir . '<br/>');
    }
    
});