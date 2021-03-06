<?php

namespace app\Repository;
use app\models\Article;

use app\Exceptions\NotFoundHttpException;

/**
 * Description of ArticleRepository.
 *
 * @author Sabri Hamda
 */
class ArticleRepository extends DBConnexion
{

    /**
     * @return array
     */
    public function getArticles()
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM posts');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Article::class);
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
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Article::class);
        return $stmt->fetch();


    }

    public function updateArticle(Article $article)
    {
        $connection = $this->getDb()->getConnection();
        if (empty($article->getImage())) {
            $stmt = $connection->prepare('UPDATE posts SET title = :articleTitle, content = :articleContent, chapo = :articleChapo WHERE id = :articleId');
        }else{
            $stmt = $connection->prepare('UPDATE posts SET title = :articleTitle, image = :articleImageUrl, content = :articleContent, chapo = :articleChapo WHERE id = :articleId');
            $stmt->bindValue(':articleImageUrl',$article->getImage(),\PDO::PARAM_STR);
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
        $stmt = $connection->prepare('INSERT INTO posts (user_id, title, image, content, chapo) VALUES (:userId, :articleTitle, :articleImageUrl, :articleContent, :articleChapo)');
        $stmt->bindValue(':userId',1,\PDO::PARAM_INT);
        $stmt->bindValue(':articleTitle',$article->getTitle(),\PDO::PARAM_STR);
        $stmt->bindValue(':articleImageUrl',$article->getImage(),\PDO::PARAM_STR);
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
