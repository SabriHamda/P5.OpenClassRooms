<?php 
namespace blog\src\model;
use blog\src\model\Manager;

/**
 * 
 */
class CommentManager extends Manager{
/**
 * [getComments description]
 * @param  [type] $articleId [description]
 * @return [type]         [description]
 */
	public function getComments($articleId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment,civilite,is_valid, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
		$comments->execute(array($articleId));

		return $comments;
	}
/**
 * [postComment description]
 * @param  [type] $articleId   [description]
 * @param  [type] $author   [description]
 * @param  [type] $comment  [description]
 * @param  [type] $civility [description]
 * @return [type]           [description]
 */
	public function postComment($articleId, $author, $comment, $civility, $role)

	{

		$db = $this->dbConnect(); 
		$comments = $db->prepare('INSERT INTO comments(post_id, author, comment,civilite, is_valid, comment_date) VALUES(?, ?, ?, ?, ?, NOW())');
		$is_valid = ($role == 'admin') ? 1 : 0;
		$affectedLines = $comments->execute(array($articleId, $author, $comment, $civility,$is_valid));


		return $affectedLines;

	}

	public function updateCommentValidity($id){
		$db = $this->dbConnect();
		$comments = $db->prepare('UPDATE comments SET is_valid = :is_valid WHERE id = :id');
		$comments->bindValue(':id',$id,\PDO::PARAM_INT);
		$comments->bindValue(':is_valid',1,\PDO::PARAM_INT);
		$comments->execute();
	}
	

}