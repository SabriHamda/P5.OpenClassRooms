<?php
namespace blog\src\model;
use blog\src\model\Manager;
/**
 * This class will connect to the data base to manage the users
 */
class UserManager extends Manager{
	

	/**
	* this function inssert the user in the db.
 	* @param string $role     the role of user.
 	* @param string $prenom   the name of user.
 	* @param string $password the password of user.
 	* @param string $email    the email of user.
 	* @param string $civility the civility of user.
	 * @return array          all information from the user.
	 */
	public function registerUser($role, $prenom, $password, $email, $civility)

	{

		$db = $this->dbConnect();

		$register = $db->prepare('INSERT INTO users(role, prenom, password, email, civilite, register_date, updated_date) VALUES(?, ?, ?, ?, ?, NOW(), NOW())');

		$affectedLines = $register->execute(array($role, $prenom, $password, $email, $civility));


		return $affectedLines;

	}
	
	/**
	 * This function select user in db with the given email.
	 * @param  string $email    the email of the user.
	 * @param  string $password the password of the user.
	 * @return array  $identity all informations from the user.
	 */
	public function userLogin($email,$password)

	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT role, prenom, password, email, civilite FROM users WHERE email = :email');
		$req->bindValue(':email',$email,\PDO::PARAM_STR);
		$req->execute();
		$identity = $req->fetch();

		return $identity;

	}
	

}