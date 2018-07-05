<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 20:13
 */

namespace src\Controllers\Frontend;


class ErrorController extends Controller
{
    public function index()
    {
        echo $this->render('errorView.twig',['message'=>'une grave erreur mon ami']);
    }
}