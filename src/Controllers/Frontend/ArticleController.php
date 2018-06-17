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
    public function index()
    {
        echo $this->render('articles/index.twig');
    }

    // view article by id
    public function view($id)
    {
        $article = $this->getArticle($id);
        echo $this->render('articles/view.twig');
    }

    //create a new article
    public function create()
    {
        echo $this->render('articles/create.twig');
    }

    //update article
    public function update($id)
    {
        echo $this->render('articles/update.twig');
    }

    //delete existing article
    public function delete($id)
    {
        $article = $this->getArticle($id);
        echo 'article delete';
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    private function getArticle($id)
    {
        $article = ArticleRepository::find($id);
        if (null === $article) {
            throw new NotFoundHttpException('Articles doesn\'t exist!');
        }

        return $article;
    }

    public function getArticles()
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();
        return $articles;
    }

}
