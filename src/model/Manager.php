<?php 
namespace blog\src\model;
class Manager{

	protected function dbConnect()
	{

		$db = new \PDO('mysql:host=localhost;dbname=my_blog;charset=utf8', 'root', 'password');
		return $db;

	}
}