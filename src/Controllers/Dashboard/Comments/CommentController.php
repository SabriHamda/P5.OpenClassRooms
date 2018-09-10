<?php
namespace app\Controllers\Dashboard\Comments;
use app\Controllers\Dashboard\ProtectedController;
use app\Repository\commentRepository;
use app\Models\Comment;



/**
 * Class CommentController
 * @package app\Controllers\Dashboard\Comments
 */
class CommentController extends ProtectedController
{

private $data;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->uri = blog()->getRequest()->getUri();
        $this->user = blog()->getIdentity()->getUser();
    }



    /**
     * [validateThisComment description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function validateThisComment(int $id){

        $this->data = new Comment();
        $this->data->setId($id);

        $updateComment = new CommentRepository();
        $validationProcess =  $updateComment->updateCommentValidity($this->data);
        if ($validationProcess)
        {
            echo $this->getRequest()->redirect('/dashboard');
        }
        echo "<script>alert('Oups le commentaire na pas pu étre validé');</script>";

    }

    public function deleteComment($commentId)
    {
        $this->data = new Comment();
        $this->data->setId($commentId);
        $delComment = new commentRepository();
        $delProcess = $delComment->deleteComment($this->data);
        if ($delProcess)
        {
            echo $this->getRequest()->redirect('/dashboard');
        }
        echo "<script>alert('Oups le commentaire na pas pu étre suprimé');</script>";
    }
}

