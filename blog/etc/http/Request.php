<?php
namespace blog\etc\http;
/**
 * Description of Request
 *
 * @author Sabri Hamda
 */
class Request {
    
    public function get($param = null, $default = null){
        if($param !== null){
            if(isset($_GET[$param])){
                return $_GET[$param];
            }else{
                return $default;
            }
        }
        return $_GET;
    }
    
    public function post($param = null, $default = null){
        if($param !== null){
            if(isset($_POST[$param])){
                return $_POST[$param];
            }else{
                return $default;
            }
        }
        return $_POST;
    }
    
    public function getUri(){
        return $_SERVER['REQUEST_URI'];
    }
    
    public function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}
