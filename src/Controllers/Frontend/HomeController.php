<?php

namespace src\Controllers\Frontend;


/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class HomeController extends Controller
{
    public function index()
    {
        $articleController = new ArticleController();
        $articles = $articleController->getArticles();
        echo $this->render('home.twig', ['articles' => $articles, 'user'=>$this->user]);
    }
}
