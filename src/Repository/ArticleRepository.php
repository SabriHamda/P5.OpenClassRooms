<?php

namespace src\Repository;

use src\Exceptions\NotFoundHttpException;

/**
 * Description of ArticleRepository.
 *
 * @author Sabri Hamda
 */
class ArticleRepository extends Model
{

    private $id;
    public $title;
    private $content;
    private $content_right;
    private $image;
    private $created_at;
    private $updated_at;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getContentRight()
    {
        return $this->content_right;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image = urldecode($this->image);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }


    public function getArticles()
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM posts');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();


    }

    public function getArticle($articleId)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT id, title, content,content_right,image, created_at FROM posts WHERE id = :id');
        $stmt->bindValue(':id',$articleId,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();



    }

    public static function find($condition)
    {
        return new self();
    }


    public function findOrFail($id)
    {
        $article = false;
        if (!$article) {
            throw new NotFoundHttpException('This article doesnt exist!');
        }
    }
}
