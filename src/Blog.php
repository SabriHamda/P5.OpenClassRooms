<?php

namespace src;

use etc\http\Request;
use etc\router\Router;

class Blog
{
    protected $request;
    protected $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->handleRequest();
    }
}
