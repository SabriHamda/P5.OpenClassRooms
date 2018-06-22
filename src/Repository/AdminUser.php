<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace src\Repository;

/**
 * Description of AdminUser
 *
 * @author Sabri Hamda
 */
class AdminUser extends DBConnexion
{

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $password_reset_token;
    protected $user;

    public function validate()
    {
        $error = 'Invalid email address or password';
        if (empty($this->email) || empty($this->password)) {
            $this->addError('email', $error);
            return false;
        }
        if (!$this->validateEmail($error)) {
            return false;
        }

        $this->user = $this->getUserByEmail();

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

    /**
     * validate the email address
     * 
     * @param string $errorMessage
     * @return boolean
     */
    protected function validateEmail($errorMessage)
    {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (!preg_match($pattern, $this->email)) {
            $this->addError('email', $errorMessage);
            return false;
        }
        return true;
    }

    /**
     * Login the user
     * 
     * @return boolean
     */
    public function login()
    {
        return blog()->getIdentity()->login($this->user->id, true);
    }

    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Validate the supplied password
     * against the stored password
     * 
     * @param string $supliedPassword
     * @param string $password
     * @return boolean
     */
    protected function validatePassword($supliedPassword, $password)
    {
        password_verify(password_hash($supliedPassword,PASSWORD_DEFAULT),$password);
            return true;
    }

    public function getUserByEmail()
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function getByPk($id)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function getFullname()
    {
        return ucwords($this->firstname . ' ' . $this->lastname);
    }

    public function generateToken()
    {
        if (!$this->validateEmail('Invalid email address!')) {
            return false;
        }
        $token = bin2hex(random_bytes(32));
        $user = $this->getUserByEmail();
        $user->password_reset_token = $token;
        if (!$user->update(['password_reset_token'])) {
            $this->addError('email', 'Oops something went wrong!');
            return false;
        }
        if (!blog()->getMailer()->sendRecoveryToken($user)) {
            return false;
        }
        return true;
    }
    public function update($var)
    {
        return true;
        exit();
    }
}
