<?php

namespace src;

use etc\http\Request;
use etc\router\Router;
use etc\session\Identity;
use etc\session\Session;
use etc\mail\Mailer;

class Blog
{
    protected $request;
    protected $router;
    protected $mailer;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        $session = new Session();
        $this->identity = new Identity($session);
        $this->mailer = new Mailer;
    }

    public function run()
    {
        $this->router->handleRequest();
    }
    
    public function getIdentity(){
        return $this->identity;
    } 
    
    public function getRequest(){
        return $this->request;
    }
    
    public function getMailer(){
        return $this->mailer;
    }
}
