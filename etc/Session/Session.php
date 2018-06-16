<?php

namespace etc\Session;

/**
 * Description of Session
 *
 * @author sabri hamda
 */
class Session {
    
    public function __construct() {
        session_start();
    }
    
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    public function get($key, $default = null){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return $default;
    }
    
    public function remove($key){
        unset($_SESSION[$key]);
        return true;
    }
}
