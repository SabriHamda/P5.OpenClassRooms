<?php

namespace src\Controllers\Dashboard;

use src\Exceptions\NotFoundHttpException;
use src\Repository\ArticleRepository;
use src\Tools\Pagination;

/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class ArticleController extends ProtectedController
{
    private $articlePaginate;
    private $articleCountPages;
    private $articlePage;

    //List all articles
    public function index($page)
    {
        $uri = blog()->getRequest()->getUri();
        $user = blog()->getIdentity()->getUser();
        $this->paginateArticles($page);


        echo $this->render('listArticlesView.twig', [
            'user' => $user,
            'uri' => $uri,
            'articles' => $this->articlePaginate,
            'page' => $this->articlePage,
            'countPages' => $this->articleCountPages
        ]);
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

    // load article from database
    // throw 404 if article is not found;
    private function getArticle($id)
    {
        $article = ArticleRepository::find($id);
        if (null === $article) {
            throw new NotFoundHttpException('ArticleRepository doesn\'t exist!');
        }

        return $article;
    }

    private function paginateArticles($page)
    {
        if (empty($page)) {
            $this->articlePage = 1;
        }

        $pagination = new Pagination();
        $paginate = $pagination->run('posts', 4, $page);
        $countPages = $pagination->getCountPages();
        $this->articlePaginate = $paginate;
        $this->articleCountPages = $countPages;
        $this->articlePage = $page;
    }
}
