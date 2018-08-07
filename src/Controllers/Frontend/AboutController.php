<?php

namespace src\Controllers\Frontend;

/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class AboutController extends FrontendController
{
    public function index()
    {
        echo $this->render('about.twig',['user'=>$this->user]);
    }
}
