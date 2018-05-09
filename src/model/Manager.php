<?php 
namespace blog\src\model;
/**
 * 
 */
class Manager{

	protected $db;
	protected $host = 'localhost';
	protected $dbName = 'p5_blog';
	protected $login = 'root';
	protected $password = 'password';

	protected function dbConnect()
	{

		try {

		$db = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8', $this->login,$this->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

		} catch (\Exception $e) {
			 die('Erreur : '.$e->getMessage());
		}
		return $db;
	}
}
