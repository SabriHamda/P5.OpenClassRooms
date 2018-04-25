<?php
namespace blog\src\controller;
use blog\src\model\ArticleManager;
use blog\src\model\CommentManager;


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
        $comments = $commentManager->getComments($_GET['id']);
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
        $addNewArticle = new ArticleManager();
        $addNewArticle->addArticle($articleTitle,$articleImageUrl,$articleContent,$articleContentRight);

    }

    public static function updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent,$articleContentRight)
    {
        $updateArticle = new ArticleManager();
        $updateArticle->updateArticle($articleId,$articleTitle,$articleImageUrl,$articleContent,$articleContentRight);

    }

}