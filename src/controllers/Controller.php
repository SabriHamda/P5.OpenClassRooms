<?php

namespace src\controllers;

/**
 * Description of DashboardController.
 *
 * @author Sabri Hamda
 */
abstract class Controller
{
    private $request;
    private $loader;

    public function __construct($request)
    {
        $this->request = $request;
        $this->loader = new \Twig_Loader_Filesystem($this->getViewsBasePath());
        $this->twig = new \Twig_Environment($this->loader, array(
            //'cache' => false,
        ));
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function render($view, $params = [])
    {
        return $this->twig->render($view, $params);
    }
}
