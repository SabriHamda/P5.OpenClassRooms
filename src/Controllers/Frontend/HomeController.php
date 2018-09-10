<?php

namespace app\Controllers\Frontend;


/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class HomeController extends FrontendController
{
    public function index()
    {
        $user = blog()->getIdentity()->getUser();
        $articleController = new ArticleController();
        $articles = $articleController->getArticles();
        echo $this->render('home.twig', ['articles' => $articles, 'user'=>$user]);

    }
}
