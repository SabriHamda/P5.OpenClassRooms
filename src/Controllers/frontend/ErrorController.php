<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.06.18
 * Time: 20:13
 */

namespace src\Controllers\frontend;


class ErrorController extends Controller
{
    public function index()
    {
        echo $this->render('errorView.twig',['message'=>'une grave erreur mon ami']);
    }
}