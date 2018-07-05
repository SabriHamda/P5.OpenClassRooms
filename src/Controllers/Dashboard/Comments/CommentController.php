<?php
namespace src\Controllers\Dashboard\Comments;
use src\Repository\commentRepository;
use src\Models\Comment;


/**
 * Class CommentController
 * @package src\Controllers\Dashboard\Comments
 */
class CommentController
{




    /**
     * [validateThisComment description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function validateThisComment(int $id){

        $data = new Comment();
        $data->setId($id);

        $updateComment = new commentRepository();
        $updateComment->updateCommentValidity($data);

    }

    public static function deleteComment($commentId)
    {
        $data = new Comment();
        $data->setId($commentId);

        $delComment = new commentRepository();
        $delComment->deleteComment($data);
    }
}

