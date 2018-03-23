<?php
namespace blog\src\controller;
use blog\src\model\UserManager;

/**
* 
*/
class UserController
{
	
	public function addUser($prenom, $password, $email, $civility)

{
	$addUser = new UserManager();
    $affectedLines = $addUser->registerUser($prenom, password_hash($password,PASSWORD_DEFAULT), $email, $civility);


    if ($affectedLines === false) {

        throw new \Exception("Impossible de vous enregistrer ohh! ");
          

    }

    else {

        header('Location: index.php?action=accueil');

    }

    

}
}