<?php

namespace core\Http;

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
            }
            return $default;
        }
        return $_GET;
    }

    public function post($param = null, $default = null)
    {// WPCS: XSS OK
        if (null !== $param) {
            if (// WPCS: XSS OK
            isset($_POST[$param])) {// WPCS: XSS OK
                return $_POST[$param];
            }
            return $default;

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

    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        //exit();
    }
}
