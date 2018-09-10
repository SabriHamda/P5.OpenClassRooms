<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 18:42
 */

namespace app\Controllers\Frontend;
use app\Models\Article;
use app\Tools\Pagination;


class BlogController extends FrontendController
{
    public function index($page)
    {
        if (empty($page)){
            $page = 1;
        }

        $pagination = new Pagination();
        $paginate = $pagination->run('posts', 4,$page);
        $countPages = $pagination->getCountPages();

        echo $this->render('blog.twig',['articles'=>$paginate,'page'=>$page,'countPages'=>$countPages,'user'=>$this->user]);

    }
}