<?php
/**
 * Created by Sabri Hamda.
 * Date: 29.06.18
 * Time: 13:53
 */

namespace src\Controllers\Frontend;

use src\Exceptions\NotFoundHttpException;
use src\Repository\CommentRepository;

class CommentController
{
    /**
     * @return array
     */
    public function getComments()
    {
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->getComments();
        return $comments;
    }


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
        $data = new Comment();
        $data->setId($articleId);
        $data->setAuthor($author);
        $data->setComment($comment);
        $data->setCivilite($civility);
        $data->setIsValid($is);
        $commentRepository = new CommentRepository();
        $affectedLines = $commentRepository->addComment($data);
        if ($affectedLines === false) {
            throw new \Exception("Impossible d\'ajouter le commentaire !");
        }
        else {
            header('Location: index.php?action=post&id=' . $articleId . '#comments');
        }
    }
}
