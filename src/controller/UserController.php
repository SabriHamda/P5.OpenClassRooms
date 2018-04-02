<?php
namespace blog\src\controller;
use blog\src\model\UserManager;


/**
* This class will users functions
*/

class UserController

{
   
   
    /**
     * this function register the users in the db.
     * @param string $role     the role of users.
     * @param string $prenom   the name of users.
     * @param string $password the password of users.
     * @param string $email    the email of users.
     * @param string $civility the civility of users. 
     */
    	public function addUser($role,$prenom,$password,$email,$civility)

        {
        	$addUser = new UserManager();
            $affectedLines = $addUser->registerUser($role, $prenom, password_hash($password,PASSWORD_DEFAULT), $email, $civility);
            if ($affectedLines === false) 
            {
                throw new \Exception("Impossible de vous enregistrer ohh! ");
            }
            else {
                $_SESSION['role'] = $role;
                $_SESSION['civility'] = $civility;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                header('Location: index.php?action=accueil');
            }
        }

        /**
         * This function login and start session if user exist.
         * @param  string $email    [description]
         * @param  string $password [description]
         * @return string session start   [description]
         */
        public function login($email,$password)

        {
            $loginUser = new UserManager();
            $identity = $loginUser->userLogin($email,$password);
            if ($identity === false) {
                throw new \Exception("email ou mot de passe invalid ");
            }
            else {
                if (!password_verify($password,$identity['password'])) {
                    throw new \Exception("mot de passe invalide ");
                }
                else{

                $_SESSION['role'] = $identity['role'];
                $_SESSION['civility'] = $identity['civilite'];
                $_SESSION['prenom'] = $identity['prenom'];
                $_SESSION['password'] = $identity['password'];
                $_SESSION['email'] = $identity['email'];
                header('Location: index.php?action=accueil');
                }   
            }
        }

    /**
     * This function close session.
     * @return page return to the main page.
     */
    public function logOut(){
        session_destroy();
        header('Location: index.php?action=accueil');
    }
}