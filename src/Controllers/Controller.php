<?php

namespace src\Controllers;

/**
 * Description of DashboardController.
 *
 * @author Sabri Hamda
 */
abstract class Controller
{
    private $request;
    private $loader;
    public $user;
    public $message = [];

    public function __construct($request)
    {
        $this->user = blog()->getIdentity()->getUser();

        $this->request = $request;
        $this->loader = new \Twig_Loader_Filesystem($this->getViewsBasePath());
        $this->twig = new \Twig_Environment($this->loader, array(
            //'cache' => false,
            'debug' => true,
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function render($view, $params = [])
    {
        return $this->twig->render($view, $params);
    }

    /**
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param array $message
     */
    public function setMessage($message)
    {
        $this->message= $message;
    }
}
