<?php
/**
 * Created by Sabri Hamda.
 * Date: 29.06.18
 * Time: 13:53
 */

namespace app\Controllers\Frontend;

use app\Validator\Validator;
use app\Validator\Constraints\IsNotEmpty;
use app\Models\Comment;
use app\Repository\CommentRepository;

class CommentController extends FrontendController
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
    public function addComment($articleId)

    {
        $role = $this->user->role;
        $validator = new Validator();
        $entry = blog()->getRequest();
        $updateViolations = $validator->validate($entry->post(), [new IsNotEmpty()]);
        if ($updateViolations){
            $isValid = ($role == 'admin') ? 1 : 0;
            $data = new Comment();
            $data->setPostId($articleId);
            $data->setAuthor($this->user->name);
            $data->setComment($entry->post('comment'));
            $data->setCivility($this->user->civility);
            $data->setIsValid($isValid);
            $commentManager = new CommentRepository();
            $affectedLines = $commentManager->addComment($data);
            if ($affectedLines === false) {
                $this->getRequest()->redirect('/article/'.$articleId);
                throw new \Exception("Impossible d\'ajouter le commentaire !");
            }
            else {
                $this->getRequest()->redirect('/article/'.$articleId);
            }
        }

    }
}
