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

		$db = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8', $this->login,$this->password);
		return $db;

	}
}