<?php
/**
 * Created by Sabri Hamda.
 * Date: 17.06.18
 * Time: 15:11
 */

namespace src\Controllers\Frontend;

use src\Models\Article;
use src\Repository\ArticleRepository;
use src\Repository\CommentRepository;


class PostController extends Controller
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