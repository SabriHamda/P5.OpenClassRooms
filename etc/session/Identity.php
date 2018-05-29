<?php

namespace etc\session;

/**
 * Description of Identity
 *
 * @author sabri hamda
 */
class Identity {

    private $_session;

    public function __construct(Session $session) {
        $this->_session = $session;
    }

    public function isLoggedIn() {
        return true;
    }

    public function Login($user) {
        
    }

    public function Logout() {
        
    }

    public function isAdmin() {
       return false; 
    }
}
