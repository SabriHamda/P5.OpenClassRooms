<?php
namespace blog\src\model;
use blog\src\model\Manager;

class UserManager extends Manager{
	


	public function registerUser($role, $prenom, $password, $email, $civility)

	{

		$db = $this->dbConnect();

		$register = $db->prepare('INSERT INTO users(role, prenom, password, email, civilite, register_date, updated_date) VALUES(?, ?, ?, ?, ?, NOW(), NOW())');

		$affectedLines = $register->execute(array($role, $prenom, $password, $email, $civility));


		return $affectedLines;

	}
	

}