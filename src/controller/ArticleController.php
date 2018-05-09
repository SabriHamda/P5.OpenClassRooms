<?php
namespace blog\src\controller;
use blog\src\model\ArticleManager;
use blog\src\model\CommentManager;
use blog\src\model\ArticleHydrate;


/**
* 
*/
class ArticleController
{
	
	 /**
     * [listPosts description]
     * @return [type] [description]
     */
    public function listArticles()

    {
    	$ArticleManager = new ArticleManager();
        $posts = $ArticleManager->getArticles();
        return $posts;

    }

    /**
     * [post description]
     * @return [type] [description]
     */
    public function article($articleId)

    {
    	$articleManager = new ArticleManager();
    	$commentManager = new CommentManager();
        $article = $articleManager->getArticle($articleId);
        $comments = $commentManager->getComments($articleId);
        return ['post'=> $article, 'comments'=> $comments];

    }

	 /**
     * [addArticle description]
     * @param [type] $articleTitle    [description]
     * @param [type] $articleImageUrl [description]
     * @param [type] $articleContent  [description]
     */
    public static function addArticle($articleTitle,$articleImageUrl,$articleContent,$articleContentRight)
    {
        $data = new ArticleHydrate();
        $data->setTitle($articleTitle);
        $data->setImage($articleImageUrl);
        $data->setContent($articleContent);
        $data->setContentRight($articleContentRight);

        $addNewArticle = new ArticleManager();
        $addNewArticle->addArticle($data);

    }

    public static function updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent,$articleContentRight)
    {
        $data = new ArticleHydrate();
        $data->setId($articleId);
        $data->setTitle($articleTitle);
        $data->setImage($articleImageUrl);
        $data->setContent($articleContent);
        $data->setContentRight($articleContentRight);

        $updateArticle = new ArticleManager();
        $updateArticle->updateArticle($data);

    }

    public static function deleteArticle($articleId)
    {
        $data = new ArticleHydrate();
        $data->setId($articleId);

        $delArticle = new ArticleManager();
        $delArticle->deleteArticle($data);
    }

}
