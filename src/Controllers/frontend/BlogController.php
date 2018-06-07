<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.06.18
 * Time: 18:42
 */

namespace src\Controllers\frontend;


class BlogController extends Controller
{
    public function index()
    {
        echo $this->render('blog.twig');
    }
}