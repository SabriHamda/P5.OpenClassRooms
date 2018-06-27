<?php

namespace etc\Http;
use src\Validator\Validator;

/**
 * Description of Request.
 *
 * @author Sabri Hamda
 */
class Request
{
    public function get($param = null, $default = null)
    {
        if (null !== $param) {
            if (isset($_GET[$param])) {
                return $_GET[$param];
            } else {
                return $default;
            }
        }

        return $_GET;
    }

    public function post($param = null, $default = null)
    {
        if (null !== $param) {
            if (// WPCS: XSS OK
                isset($_POST[$param]) && !empty($_POST[$param])) {
                return $_POST[$param];
            } else {
                return $default;
            }
        }
        return $_POST;
    }

    public function getUri()
    {
        return rtrim($_SERVER['REQUEST_URI'], '/');
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function redirect($url, $permanent = false){
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
}
