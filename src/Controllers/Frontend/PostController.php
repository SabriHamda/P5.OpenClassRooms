<?php
/**
 * Created by Sabri Hamda.
 * Date: 17.06.18
 * Time: 15:11
 */

namespace src\Controllers\Frontend;

use src\Models\Article;
use src\Repository\ArticleRepository;


class PostController extends Controller
{

    public function index($articleId)
    {


        $articleRepository = new ArticleRepository();
        $data = $articleRepository->getArticle($articleId);
        foreach($data as $article){
            $contentRight = $article->getContentRight();

        }
        echo $this->render('articleView.twig', ['data' => $data,'contentRight'=>$contentRight]);

    }


}