<?php

namespace app;

use core\Http\Request;
use core\Router\Router;
use core\Session\Identity;
use core\Session\Session;
use core\Mail\Mailer;

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
