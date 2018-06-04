<?php

namespace src;

use etc\http\Request;
use etc\router\Router;
use etc\session\Identity;
use etc\session\Session;
class Blog
{
    protected $request;
    protected $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        $session = new Session();
        $this->identity = new Identity($session);
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
}
