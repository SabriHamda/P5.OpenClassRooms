<?php
namespace blog\src\controller;
use blog\src\model\CommentManager;
use blog\src\model\CommentHydrate;


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
    	$is = ($role == 'admin') ? 1 : 0;

    	$data = new CommentHydrate();
        $data->setId($articleId);
        $data->setAuthor($author);
        $data->setComment($comment);
        $data->setCivilite($civility);
        $data->setIsValid($is);

    	$commentManager = new CommentManager();
        $affectedLines = $commentManager->addComment($data);
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

		$data = new Commenthydrate();
		$data->setId($id);

        $updateComment = new CommentManager();
        $updateComment->updateCommentValidity($data);

    }
}
