<?php

namespace src\Repository;
use src\models\Article;

use src\Exceptions\NotFoundHttpException;

/**
 * Description of ArticleRepository.
 *
 * @author Sabri Hamda
 */
class ArticleRepository extends DBConnexion
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
    private $chapo;
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
    public function getChapo()
    {
        return $this->chapo;
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
        $stmt = $connection->prepare('SELECT id, title, content,chapo,image, created_at FROM posts WHERE id = :id');
        $stmt->bindValue(':id', $articleId, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();


    }

    public function updateArticle(Article $article)
    {
        $connection = $this->getDb()->getConnection();
        if (empty($article->getImage())) {
            $stmt = $connection->prepare('UPDATE posts SET title = :articleTitle, content = :articleContent, chapo = :articleChapo WHERE id = :articleId');
        }else{
            $stmt = $connection->prepare('UPDATE posts SET title = :articleTitle, image = :articleImageUrl, content = :articleContent, chapo = :articleChapo WHERE id = :articleId');
            $stmt->bindValue(':articleImageUrl',urlencode($article->getImage()),\PDO::PARAM_STR);
        }
        $stmt->bindValue(':articleId',$article->getId(),\PDO::PARAM_INT);
        $stmt->bindValue(':articleTitle',$article->getTitle(),\PDO::PARAM_STR);
        $stmt->bindValue(':articleContent',$article->getContent(),\PDO::PARAM_STR);
        $stmt->bindValue(':articleChapo',$article->getChapo(),\PDO::PARAM_STR);
        $stmt->execute();

    }

    public function addArticle(Article $article)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('INSERT INTO posts (title, image, content, chapo) VALUES (:articleTitle, :articleImageUrl, :articleContent, :articleChapo)');
        $stmt->bindValue(':articleTitle',$article->getTitle(),\PDO::PARAM_STR);
        $stmt->bindValue(':articleImageUrl',urlencode($article->getImage()),\PDO::PARAM_STR);
        $stmt->bindValue(':articleContent',$article->getContent(),\PDO::PARAM_STR);
        $stmt->bindValue(':articleChapo',$article->getChapo(),\PDO::PARAM_STR);
        $stmt->execute();

    }
    public function deleteArticle(Article $article)
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('DELETE FROM posts WHERE id = :articleId');
        $stmt->bindValue(':articleId', $article->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }
}
