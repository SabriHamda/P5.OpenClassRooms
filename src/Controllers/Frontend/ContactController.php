<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 18:46
 */

namespace src\Controllers\Frontend;


class ContactController extends Controller
{
    public function index()
    {
        echo $this->render('contact.twig',['user'=>$this->user]);
    }
}