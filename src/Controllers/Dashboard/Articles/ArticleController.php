<?php

namespace src\Controllers\Dashboard\Articles;

use src\Controllers\Dashboard\ProtectedController;
use src\Repository\ArticleRepository;
use src\Tools\Pagination;
use src\models\Article;



/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class ArticleController extends ProtectedController
{
    use UpdateArticleController;
    use CreateArticleController;


    private $uri;
    public $user;
    private $articlePaginate;
    private $articleCountPages;
    private $articlePage;
    public $article;
    //public $message = [];


    public function __construct($request)
    {
        parent::__construct($request);
        $this->uri = blog()->getRequest()->getUri();
        $this->user = blog()->getIdentity()->getUser();
    }

    //List all articles
    public function index($page)
    {
        $this->paginateArticles($page);
        echo $this->render('listArticlesView.twig', [
            'user' => $this->user,
            'uri' => $this->uri,
            'articles' => $this->articlePaginate,
            'page' => $this->articlePage,
            'countPages' => $this->articleCountPages
        ]);
    }


    public function editArticle($articleId)
    {
        $this->articleId = $articleId;
        $this->article = $this->getArticle($this->getArticleId());
        echo $this->render('editArticleView.twig', [
            'article' => $this->article,
            'user' => $this->user,
            'uri' => $this->uri,
            'message' => $this->getMessage()
        ]);
    }



    private function getArticle($articleId)
    {
        $articleRepository = new ArticleRepository();
        $this->article = $articleRepository->getArticle($articleId);
        return $this->article;
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

    public function delArticle($articleId)
    {
        $data = new Article();
        $data->setId($articleId);
        $delArticle = new ArticleRepository();
        $delArticle->deleteArticle($data);
        $this->setMessage(['status' => 'success', 'message' => '<strong>Succès ! </strong> Article suprimé avec succès']);
        $this->getRequest()->redirect('/dashboard');


    }


    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

}
