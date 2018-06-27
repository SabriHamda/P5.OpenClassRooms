<?php

namespace src\Controllers\Frontend;

use src\Exceptions\NotFoundHttpException;
use src\Repository\ArticleRepository;

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

    //create a new article

    /**
     *
     */
    public function create()
    {
        echo $this->render('articles/create.twig');
    }

    //update article

    /**
     * @param $id
     */
    public function update($id)
    {
        echo $this->render('articles/update.twig');
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
