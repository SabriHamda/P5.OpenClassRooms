<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 19:24
 */

namespace src\Controllers\Frontend;


class LoginController extends Controller
{
    public function index()
    {
        echo $this->render('loginView.twig',['user'=>$this->user]);
    }
}