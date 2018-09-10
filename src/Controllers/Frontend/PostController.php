<?php
/**
 * Created by Sabri Hamda.
 * Date: 17.06.18
 * Time: 15:11
 */

namespace app\Controllers\Frontend;

use app\Models\Article;
use app\Repository\ArticleRepository;
use app\Repository\CommentRepository;


class PostController extends FrontendController
{

    public function index($articleId)
    {

        $articleRepository = new ArticleRepository();
        $commentRepository = new CommentRepository();
        $article = $articleRepository->getArticle($articleId);
        $comments = $commentRepository->getComments($articleId);


        echo $this->render('articleView.twig', ['article' => $article,'comments'=>$comments, 'user' => $this->user]);

    }


}