<?php

namespace src\Repository;
use src\Models\Comment;


/**
 *
 */
class CommentRepository extends DBConnexion
{

    public function getAllComments()
    {
        $connection = $this->getDb()->getConnection();
            $stmt = $connection->prepare('SELECT * FROM comments');
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
            return $stmt->fetchAll();
    }


    /**
     * [getComments description]
     * @param  [INT] $articleId [description]
     * @return [OBJ]         [description]
     */
    public function getComments($articleId)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT id, author, comment,civility,is_valid, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = :articleId ORDER BY comment_date DESC');
        $stmt->bindValue(':articleId',$articleId,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * [addComment description]
     * @param  [INT] $articleId   [description]
     * @param  [STRING] $author   [description]
     * @param  [STRING] $comment  [description]
     * @param  [STRING] $civility [description]
     * @return [OBJ]           [description]
     */
    public function addComment(Comment $comment)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('INSERT INTO comments(post_id, author, comment,civility, is_valid, comment_date) VALUES(?, ?, ?, ?, ?, NOW())');
        $affectedLines = $stmt->execute(array(
            $comment->getId(),
            $comment->getAuthor(),
            $comment->getComment(),
            $comment->getCivilite(),
            $comment->getIsValid()
        ));
        return $affectedLines;
    }

    public function updateCommentValidity(Comment $comment)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('UPDATE comments SET is_valid = :is_valid WHERE id = :id');
        $stmt->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $stmt->bindValue(':is_valid', 1, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteComment(Comment $comment)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('DELETE FROM comments WHERE id = :commentId');
        $stmt->bindValue(':commentId', $comment->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }

}
