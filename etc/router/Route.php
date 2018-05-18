<?php

namespace etc\router;

class Route {

    const PARAMETERS_REGEX_FORMAT = '%s([\w]+)(\%s?)%s';
    const PARAMETERS_DEFAULT_REGEX = '[\w]+';
    protected $urlRegex = '/^%s\/?$/u';
    protected $paramModifiers = '{}';
    protected $paramOptionalSymbol = '?';
    
    private $path;
    private $action;
    private $controller;
    private $params = [];
    private $method;
    private $parameters;

    public function __construct($path, $controller, $action, $params = null, $method = 'GET') {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->method = $method;
    }

    public function getController() {
        return $this->controller;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getMethod() {
        return $this->method;
    }
    
    public function getAction(){
        return $this->action;
    }

    public function getParamName() {
        if(is_array($this->params)){
        reset($this->params);
        return key($this->params);
        }
        return false;
    }
    
    public function getParameterValue(){
        $key = $this->getParamName();
        if($key && !empty($this->parameters) && isset($this->parameters[$key])){
            return $this->parameters[$key];
        }
        return false;
    }

    public function match($url, $method) {
        $this->parameters  = $this->parseParameters($this->getPath(), $url);
        if($this->parameters){
            $key = $this->getParamName();
            $this->setPath( str_replace('{' . $key . '}', $this->parameters[$key], $this->getPath()));
        }
        return $this->getPath() === $url && $this->getMethod() == $method;
    }

    protected function parseParameters($route, $url, $parameterRegex = null) {
        $regex = (strpos($route, $this->paramModifiers[0]) === false) ? null :
                sprintf
                        (
                        static::PARAMETERS_REGEX_FORMAT, $this->paramModifiers[0], $this->paramOptionalSymbol, $this->paramModifiers[1]
        );
        $url = '/' . ltrim($url, '/');
        $urlRegex = '';
        $parameters = [];
        if ($regex === null || (bool) preg_match_all('/' . $regex . '/u', $route, $parameters) === false) {
            $urlRegex = preg_quote($route, '/');
        } else {
            foreach (preg_split('/((\-?\/?)\{[^}]+\})/', $route) as $key => $t) {
                $regex = '';
                if ($key < \count($parameters[1])) {
                    $name = $parameters[1][$key];
                    if (isset($this->params[$name]) === true) {
                        $regex = $this->params[$name];
                    } else {
                        if ($parameterRegex !== null) {
                            $regex = $parameterRegex;
                        } else {
                            $regex = $this->defaultParameterRegex ?? static::PARAMETERS_DEFAULT_REGEX;
                        }
                    }
                    $regex = sprintf('(?:\/|\-)%1$s(?P<%2$s>%3$s)%1$s', $parameters[2][$key], $name, $regex);
                }
                $urlRegex .= preg_quote($t, '/') . $regex;
            }
        }
        if (trim($urlRegex) === '' || (bool) preg_match(sprintf($this->urlRegex, $urlRegex), $url, $matches) === false) {
            return null;
        }
        $values = [];
        if (isset($parameters[1]) === true) {
            foreach ((array) $parameters[1] as $name) {
                $values[$name] = (isset($matches[$name]) === true && $matches[$name] !== '') ? $matches[$name] : null;
            }
        }
        return $values;
    }

}
