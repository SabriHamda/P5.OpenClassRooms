<?php

namespace etc\Session;

use src\Repository\UserRepository;
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

    public function login(int $userId, $isAuthorized = false) {
        $this->_session->set($this->key, $userId);
        if($isAuthorized){
            $this->_session->set('is_authorized', true);
        }
        return true;
    }

    public function logout() {
        session_destroy();
        return $this->_session->remove($this->key);
    }

    public function isAuthorized() {
       return $this->_session->get('is_authorized',false);
    }
    
    public function getUser(){
        $id = $this->_session->get($this->key);
        if(!$id){
            return null;
        }
        $isAuthorized = $this->isAuthorized();
        $userClass = $isAuthorized ? UserRepository::class : UserRepository::class;
        $user = new $userClass;
        return $user->getByPk($id);
    }

}
