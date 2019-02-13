<?php
/**
 * User: Farkens
 */

namespace farkens\components;


class Session{
    public function __construct() {
        session_start();
    }

    public function set($name, $value) {
        if(!isset($_SESSION[$name])){
            $_SESSION[$name] = $value;
        }
    }
    public function get($name) {
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
    public function del($name) {
        unset($_SESSION[$name]);
    }

    /*
     * setter helper for flash message from session
     */
    public function setFlash( $date) {
        $_SESSION['flashMsg'] = $date;
    }

    /*
     * show helper for flash message from session
     */
    public function getFlash($name = null) {
        if( isset($_SESSION['flashMsg']) ){
            $msg = $_SESSION['flashMsg'];
            unset($_SESSION['flashMsg']);
            if($name){
            }else{
                return $msg;
            }
        }

    }
}