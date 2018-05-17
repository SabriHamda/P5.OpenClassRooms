<?php

namespace blog;

use blog\etc\http\Request;
use blog\etc\router\Router;


class Blog {
    
    protected $request;
    protected $router;


    public function __construct() {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }
    
    public function run(){
        $this->router->handleRequest();
    }
    
}
