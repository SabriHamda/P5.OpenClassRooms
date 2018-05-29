<?php

namespace etc\session;

/**
 * Description of Session
 *
 * @author sabri hamda
 */
class Session {
    
    public function __construct() {
        session_start();
    }
    
    public function setUserId($id){
        $_SESSION['uid'] = $id;
    }
    
    public function getUserId(){
        if(isset($_SESSION['uid'])){
            return $_SESSION['uid'];
        }
        return false;
    }
    
    public function unsetUserId(){
        unset($_SESSION['uid']);
    }
}
