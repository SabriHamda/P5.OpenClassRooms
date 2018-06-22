<?php

namespace src\Controllers\Dashboard;

use src\Exceptions\NotFoundHttpException;
use src\Repository\ArticleRepository;
use src\Tools\Pagination;
use src\Tools\UploadFile;
use src\Controllers\Dashboard\Validation\Validator;
use src\Models\Article;

/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class ArticleController extends ProtectedController
{
    private $uri;
    public $user;
    private $articlePaginate;
    private $articleCountPages;
    private $articlePage;
    public $article;
    public $message = array();

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
        $this->article = $this->getArticle($articleId);
        echo $this->render('editArticleView.twig', [
            'article' => $this->article,
            'user' => $this->user,
            'uri' => $this->uri,
            'message' => $this->message
        ]);

    }

    public function updateArticle($articleId)
    {
        if (Validator::articleValidate($articleId)) {
            $articleTitle = $_POST['title-article-update'];
            $articleContent = $_POST['content-article-update'];
            $articleContentRight = $_POST['content-right-article-update'];
            $articleImage = $_FILES['img-article-update'];
            if (empty($articleImage['name'])) {
                $data = new Article();
                $data->setId($articleId);
                $data->setTitle($articleTitle);
                $data->setContent($articleContent);
                $data->setContentRight($articleContentRight);
                $updateArticle = new ArticleRepository();
                $updateArticle->updateArticle($data);
                $this->message = ['status' => 'alert-success', 'message' => "<strong>Succès ! </strong> Article modifié avec succès"];
                $this->editArticle($articleId);
            } else {
                $uploadMyFile = UploadFile::uploadFile('img-article-update', 'assets/images/uploads/' . $articleImage["name"] . '', FALSE, array('png', 'gif', 'jpg', 'jpeg'));
                if ($uploadMyFile) {
                    $this->message = ['status' => 'alert-success', 'message' => "<strong>Succès ! </strong> Article modifié avec succès"];
                    $this->editArticle($articleId);
                    $data = new Article();
                    $data->setId($articleId);
                    $data->setTitle($articleTitle);
                    $data->setImage('/assets/images/uploads/' . $articleImage["name"] . '');
                    $data->setContent($articleContent);
                    $data->setContentRight($articleContentRight);
                    $updateArticle = new Articlerepository();
                    $updateArticle->updateArticle($data);
                } else {
                    $this->message = ['status' => 'alert-danger', 'message' => "<strong>Erreur ! </strong> Le format de votre image est incorrect"];
                    $this->editArticle($articleId);
                }
            }

        } else {
            $this->message = ['status' => 'alert-danger', 'message' => "<strong>Erreur!</strong> un ou plusieurs champs sont vide."];
            $this->editArticle($articleId);

        }
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
}
