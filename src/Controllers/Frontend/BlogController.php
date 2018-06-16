<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.06.18
 * Time: 18:42
 */

namespace src\Controllers\Frontend;
use src\Tools\Pagination;


class BlogController extends Controller
{
    public function index($page)
    {
        if (empty($page)){
            $page = 1;
        }
        $pagination = new Pagination();
        $paginate = $pagination->run('posts', 4,$page);
        $countPages = $pagination->countPages;

        echo $this->render('blog.twig',['articles'=>$paginate,'page'=>$page,'countPages'=>$countPages]);

    }
}