<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\Repository;
use src\Models\User;

/**
 * Description of UserRepository
 *
 * @author Sabri Hamda
 */
class UserRepository extends DBConnexion
{
    public $email;
    public $password;
    public $password_reset_token;
    protected $user;

    public function validate()
    {
        $error = 'email ou mot de passe invalide';
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
        if ($this->user->role === 'admin' || $this->user->role === 'visitor') {
            return blog()->getIdentity()->login($this->user->id, true);
        }
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
        return password_verify($supliedPassword, $password);
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

    public function generateToken()
    {
        if (!$this->validateEmail('Invalid email address!')) {
            return false;
        }
        $token = bin2hex(random_bytes(32));
        if(!($user = $this->getUserByEmail()))
        {
            $this->addError('email', 'L\'email saisi n\'existe pas');
            return false;

        }
        $user->password_reset_token = $token;
        $this->updateToken($user->email,$user->password_reset_token);
        if (!$user->updateToken($user->email,$token)) {
            $this->addError('email', 'Nous avons rencontré un probleme');
            return false;
        }
        if (!blog()->getMailer()->sendRecoveryToken($user)) {
            return false;
        }
        return true;
    }

    public function addUser(User $data)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('INSERT INTO users (role, name, password, email, civility, register_date, updated_date) VALUES (:role, :name, :password, :email, :civility, NOW(), NOW())');
        $stmt->bindValue(':role',$data->getRole(),\PDO::PARAM_STR);
        $stmt->bindValue(':name',$data->getName(),\PDO::PARAM_STR);
        $stmt->bindValue(':password',$data->getPassword(),\PDO::PARAM_STR);
        $stmt->bindValue(':email',$data->getEmail(),\PDO::PARAM_STR);
        $stmt->bindValue(':civility',$data->getCivility(),\PDO::PARAM_STR);
        $stmt->execute();
    }

    public function searchToken($token)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT email FROM users WHERE recovery_token = :token');
        $stmt->bindValue(':token',$token,\PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }


    // update token in db
    public function updateToken($email,$token)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('UPDATE users SET recovery_token = :token WHERE email = :email');
        $stmt->bindValue(':token',$token,\PDO::PARAM_STR);
        $stmt->bindValue(':email',$email,\PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    // update token in db
    public function updatePassword(User $data,$email)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('UPDATE users SET password = :password WHERE email = :email');
        $stmt->bindValue(':password',$data->getPassword(),\PDO::PARAM_STR);
        $stmt->bindValue(':email',$email,\PDO::PARAM_STR);
        return $stmt->execute();

    }
}
