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

    
    public $email;
    public $password;
    
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
        return blog()->getIdentity()->login($this->user->id, true);
    }

    public function setEmail($email) {
        $this->email = trim($email);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    protected function validatePassword($supliedPassword, $password) {
        return md5($supliedPassword) === $password;
    }

    public function getUser() {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM admin_users WHERE email = :email');
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return  $stmt->fetch(); 
    }

}
