<?php

namespace src\controllers\frontend;

use src\controllers\frontend\ArticleController;

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


        echo $this->render('home.twig', ['articles' => $articles]);
    }
}
