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

    // view article by id

    /**
     * @param $id
     */
    public function view($id)
    {
        $article = $this->getArticle($id);
        echo $this->render('articles/view.twig');
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

    //delete existing article

    /**
     * @param $id
     */
    public function delete($id)
    {
        $article = $this->getArticle($id);
        echo 'article delete';
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
