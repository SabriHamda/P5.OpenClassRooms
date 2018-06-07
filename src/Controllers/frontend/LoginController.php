<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.06.18
 * Time: 19:24
 */

namespace src\Controllers\frontend;


class LoginController extends Controller
{
    public function index()
    {
        echo $this->render('loginView.twig');
    }
}