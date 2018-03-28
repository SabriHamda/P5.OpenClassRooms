<?php 
namespace blog\src\model;
use blog\src\model\Manager;


class PostManager extends Manager{

	public function getPosts()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content,image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date #DESC LIMIT 0, 5');

		return $req;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content,image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
		$req->execute(array($postId));
		$post = $req->fetch();

		return $post;
	}

	public function countPosts()
	{
		$db = $this->dbConnect();
		$req = $db->query("SELECT  COUNT(*) as totalPosts FROM posts" );
		$donnees = $req->fetch();
		$req->closeCursor();
		return $donnees['totalPosts'];

	}
	public function getPaginatePosts($startLine, $nbResult)
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content,image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY ID LIMIT ' . $startLine . ', '. $nbResult . '');
		

		return $req;
	}
	
}