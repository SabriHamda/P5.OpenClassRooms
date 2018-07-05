<?php
/**
 * Created by Sabri Hamda.
 * Date: 29.06.18
 * Time: 02:06
 */

namespace src\Models;


class Comment
{
    protected $id;
    protected $post_id;
    protected $author;
    protected $comment;
    protected $civility;
    public $is_valid;
    protected $comment_date;

public function __construct()
{
    $this->comment = utf8_encode($this->comment);
}

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
        return $this->post_id;
    }
    public function setPotsId(string $post_id)
    {
        $this->post_id = $post_id;
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
        return $this->comment;
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
        return $this->is_valid;
    }
    public function setIsValid(int $is_valid)
    {
        $this->is_valid = $is_valid;
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
