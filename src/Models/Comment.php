<?php
/**
 * Created by Sabri Hamda.
 * Date: 29.06.18
 * Time: 02:06
 */

namespace app\Models;


class Comment
{
    protected $id;
    public $postId;
    protected $author;
    protected $comment;
    protected $civility;
    public $isValid;
    protected $comment_date;


    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId(string $postId)
    {
        $this->postId = $postId;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getComment()
    {
        return utf8_encode($this->comment);
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    public function getCivility()
    {
        return $this->civility;
    }

    public function setCivility(string $civility)
    {
        $this->civility = $civility;
    }

    public function getIsValid()
    {
        return $this->isValid;
    }

    public function setIsValid(int $isValid)
    {
        $this->isValid = $isValid;
    }

    public function getCommentDate()
    {
        return $this->comment_date;
    }

    public function setCommentDate(string $comment_date)
    {
        $this->comment_date = $comment_date;
    }

}
