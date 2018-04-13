<?php 
namespace blog\src\model;
use blog\src\model\Manager;


class PostManager extends Manager{

	public function getPosts()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content,image, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr FROM posts ORDER BY created_at #DESC LIMIT 0, 5');
		$res = $req->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($res as $key =>$element) {
			$element['image'] = urldecode($element['image']);
			$res[$key] = $element;
		}
		return $res;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content,image, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr FROM posts WHERE id = ?');
		$req->execute(array($postId));
		$post = $req->fetch();
		$post['image'] = urldecode($post['image']);
		return $post;
	}
	public function addArticle($articleTitle,$articleImageUrl,$articleContent)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts (title, image, content) VALUES (:articleTitle, :articleImageUrl, :articleContent)');
		$req->bindValue(':articleTitle',$articleTitle,\PDO::PARAM_STR);
		$req->bindValue(':articleImageUrl',urlencode($articleImageUrl),\PDO::PARAM_STR);
		$req->bindValue(':articleContent',$articleContent,\PDO::PARAM_STR);
		$req->execute();

		
	}

	public function updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent)
	{
		$db = $this->dbConnect();
		if (empty($articleImageUrl)) {
			$req = $db->prepare('UPDATE posts SET title = :articleTitle, content = :articleContent WHERE id = :articleId');
		}else{
			$req = $db->prepare('UPDATE posts SET title = :articleTitle, image = :articleImageUrl, content = :articleContent WHERE id = :articleId');
			$req->bindValue(':articleImageUrl',urlencode($articleImageUrl),\PDO::PARAM_STR);
		}
		
		$req->bindValue(':articleId',$articleId,\PDO::PARAM_INT);
		$req->bindValue(':articleTitle',$articleTitle,\PDO::PARAM_STR);
		$req->bindValue(':articleContent',$articleContent,\PDO::PARAM_STR);
		$req->execute();

		
	}

	public function countTableRows($table)
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT  COUNT(*) as totalRows FROM '. $table .'' );
		$donnees = $req->fetch();
		$req->closeCursor();
		return $donnees['totalRows'];

	}
	public function getPaginateTable($table, $startLine, $nbResult, $orderBy)
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM '. $table .' ORDER BY '. $orderBy .' LIMIT ' . $startLine . ', '. $nbResult . '');
		$res = $req->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($res as $key =>$element) {
			$element['image'] = urldecode($element['image']);
			$res[$key] = $element;
		}
		return $res;
		

		
	}
	
}