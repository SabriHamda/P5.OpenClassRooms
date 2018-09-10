<?php

namespace app\Controllers\Frontend;

use app\Exceptions\NotFoundHttpException;
use app\Repository\ArticleRepository;

/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class ArticleController
{
    //List all articles
    /**
     *
     */
    public function index()
    {
        echo $this->render('articles/index.twig');
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();
        return $articles;
    }

}
