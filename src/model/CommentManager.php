<?php 
namespace blog\src\model;
use blog\src\model\Manager;

/**
 * 
 */
class CommentManager extends Manager{

	public function __construct()
	{
		$this->db = self::dbConnect();
	}
	
/**
 * [getComments description]
 * @param  [INT] $articleId [description]
 * @return [OBJ]         [description]
 */
	public function getComments($articleId)
	{
		
		$comments = $this->db->prepare('SELECT id, author, comment,civilite,is_valid, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
		$comments->execute(array($articleId));

		return $comments;
	}
/**
 * [addComment description]
 * @param  [INT] $articleId   [description]
 * @param  [STRING] $author   [description]
 * @param  [STRING] $comment  [description]
 * @param  [STRING] $civility [description]
 * @return [OBJ]           [description]
 */
	public function addComment(CommentHydrate $comment)

	{

		 
		$comments = $this->db->prepare('INSERT INTO comments(post_id, author, comment,civilite, is_valid, comment_date) VALUES(?, ?, ?, ?, ?, NOW())');
		
		$affectedLines = $comments->execute(array(
			$comment->getId(),
			$comment->getAuthor(),
			$comment->getComment(),
			$comment->getCivilite(),
			$comment->getIsValid()
		));


		return $affectedLines;

	}

	public function updateCommentValidity(CommentHydrate $comment){
		
		$comments = $this->db->prepare('UPDATE comments SET is_valid = :is_valid WHERE id = :id');
		$comments->bindValue(':id',$comment->getId(),\PDO::PARAM_INT);
		$comments->bindValue(':is_valid',1,\PDO::PARAM_INT);
		$comments->execute();
	}
	

}