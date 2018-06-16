<?php

namespace src\Controllers\Frontend;

/**
 * Description of HomeController.
 *
 * @author Sabri Hamda
 */
class AboutController extends Controller
{
    public function index()
    {
        echo $this->render('about.twig');
    }
}
