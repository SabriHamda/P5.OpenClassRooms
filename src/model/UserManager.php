<?php
namespace blog\model;
use blog\src\model\Manager;

class UserManager extends Manager{


	public function registerUsers($nom, $prenom, $email, $civility)

	{

		$db = $this->dbConnect();

		$register = $db->prepare('INSERT INTO users(nom, prenom,email,civilite, register_date, updated_date) VALUES(?, ?, ?, ?, NOW(),NOW())');

		$affectedLines = $register->execute(array($userId, $nom, $prenom, $email, $civility));


		return $affectedLines;

	}
	

}