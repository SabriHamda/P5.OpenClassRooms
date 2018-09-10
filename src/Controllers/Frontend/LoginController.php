<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 19:24
 */

namespace app\Controllers\Frontend;


class LoginController extends FrontendController
{
    public $message = [];
    public function index()
    {
        $message = $this->message;
        echo $this->render('loginView.twig',['user'=>$this->user,'message'=>$message]);
    }
}