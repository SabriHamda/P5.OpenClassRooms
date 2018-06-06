<?php

namespace etc\session;

/**
 * Description of Identity
 *
 * @author sabri hamda
 */
class Identity {

    private $_session;
    
    private $key = 'user_id';

    public function __construct(Session $session) {
        $this->_session = $session;
    }

    public function isLoggedIn() {
        return $this->_session->get($this->key,false);
    }

    public function login(int $userId, $isAdmin = false) {
        $this->_session->set($this->key, $userId);
        if($isAdmin){
            $this->_session->set('is_admin', true);
        }
        return true;
    }

    public function logout() {
        session_destroy();
        return $this->_session->remove($this->key);
    }

    public function isAdmin() {
       return $this->_session->get('is_admin',false);
    }

}
