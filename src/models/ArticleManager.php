<?php

namespace src\models;

use src\exceptions\NotFoundHttpException;

/**
 * Description of ArticleManager.
 *
 * @author Sabri Hamda
 */
class ArticleManager extends Model
{

    public $id, $title, $content, $content_right, $image, $created_at, $updated_at;

    public function __construct()
    {
        $this->image = urldecode($this->image);

    }

    public function getArticles()
    {
        $connection = $this->getDb()->getConnection();
        $stmt = $connection->prepare('SELECT * FROM posts');
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
