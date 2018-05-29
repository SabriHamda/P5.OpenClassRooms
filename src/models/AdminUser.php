<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\models;

/**
 * Description of AdminUser
 *
 * @author Sabri Hamda
 */
class AdminUser extends Model {

    private $email;
    private $password;
    
    protected $user;

    public function validate() {
        $error = 'Invalid email address or password';
        if (empty($this->email) || empty($this->password)) {
            $this->addError('email', $error);
            return false;
        }
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (!preg_match($pattern, $this->email)) {
            $this->addError('email', $error);
            return false;
        }

        $this->user = $this->getUser();

        if (!$this->user) {
            $this->addError('email', $error);
            return false;
        }

        if (!$this->validatePassword($this->password, $this->user->password)) {
            $this->addError('email', $error);
            return false;
        }
        return true;
    }

    public function login() {
        return false;
    }

    public function setEmail($email) {
        $this->email = trim($email);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }

    protected function validatePassword($supliedPassword, $password) {
        return $supliedPassword === $password;
    }

    public function getUser() {
        $db = $this->getDb();
        $query = $db->prepare('SELECT * FROM admins WHERE email = :email');
        $query->bindParam(['email' => $this->getEmail()]);
        $user = $query->excute();
    }

}
