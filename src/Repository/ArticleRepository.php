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
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $content;
    /**
     * @var
     */
    private $content_right;
    /**
     * @var string
     */
    private $image;
    /**
     * @var
     */
    private $created_at;
    /**
     * @var
     */
    private $updated_at;

    /**
     * ArticleRepository constructor.
     */
    public function __construct()
    {
        if ($this->image) {
            $this->image = urldecode($this->image);
        }
        return null;
    }


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


    /**
     * @return array
     */
    public function getArticles()
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM posts');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();


    }

    /**
     * @param $articleId
     * @return array
     */
    public function getArticle($articleId)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT id, title, content,content_right,image, created_at FROM posts WHERE id = :id');
        $stmt->bindValue(':id', $articleId, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();


    }

    /**
     * @param $condition
     * @return ArticleRepository
     */
    public static function find($condition)
    {
        return new self();
    }


    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function findOrFail($id)
    {
        $article = false;
        if (!$article) {
            throw new NotFoundHttpException('This article doesnt exist!');
        }
    }
}
