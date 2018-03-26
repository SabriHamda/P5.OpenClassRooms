<?php 
namespace blog\src\model;
use blog\src\model\Manager;

/**
 * 
 */
class CommentManager extends Manager{
/**
 * [getComments description]
 * @param  [type] $postId [description]
 * @return [type]         [description]
 */
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment,civilite, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
		$comments->execute(array($postId));

		return $comments;
	}
/**
 * [postComment description]
 * @param  [type] $postId   [description]
 * @param  [type] $author   [description]
 * @param  [type] $comment  [description]
 * @param  [type] $civility [description]
 * @return [type]           [description]
 */
	public function postComment($postId, $author, $comment, $civility)

	{

		$db = $this->dbConnect();

		$comments = $db->prepare('INSERT INTO comments(post_id, author, comment,civilite, comment_date) VALUES(?, ?, ?, ?, NOW())');

		$affectedLines = $comments->execute(array($postId, $author, $comment, $civility));


		return $affectedLines;

	}
	

}