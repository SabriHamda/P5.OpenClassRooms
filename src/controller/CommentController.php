<?php
namespace blog\src\controller;
use blog\src\model\CommentManager;

/**
* 
*/
class CommentController
{
	
	

	 /**
     * [addComment description]
     * @param [type] $articleId   [description]
     * @param [type] $author   [description]
     * @param [type] $comment  [description]
     * @param [type] $civility [description]
     */
    public function addComment($articleId, $author, $comment, $civility, $role)

    {
    	$commentManager = new CommentManager();
        $affectedLines = $commentManager->postComment($articleId, $author, $comment, $civility, $role);
        if ($affectedLines === false) {
            throw new \Exception("Impossible d\'ajouter le commentaire !");
        }
        else {
            header('Location: index.php?action=post&id=' . $articleId . '#comments');
        }
    }

	/**
	 * [validateThisComment description]
	 * @param  int    $id [description]
	 * @return [type]     [description]
	 */
	public function validateThisComment(int $id){

        $updateComment = new CommentManager();
        $updateComment->updateCommentValidity($id);

    }
}
