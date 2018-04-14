<?php

namespace Router;

use Symfony\Component\Yaml\Yaml;
use Router\Exception\{NotRouteFoundException, NotIntegerParamException, EmptyUriException};

class Router
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function variableExtractor(string $regexUri)
    {

        if(empty($this->uri)){
            throw EmptyUriException::empty();
        }

        $params = [];

        preg_match_all('\'' . '{(\w+)}' . '\'', $regexUri, $matches);
        $matches = $matches[0];
        foreach ($matches as $key => $value) {
            $matches[$key] = str_replace('{', '', $matches[$key]);
            $matches[$key] = str_replace('}', '', $matches[$key]);
        }

        $regexUri = preg_replace('%' . '{(\w+)}' . '%', '(\w+|\d+)', $regexUri);
        $regexUri .= '$';
        $regexUri = '%^' . $regexUri . '$%';
        $res = preg_match($regexUri, $this->uri,$params);
        if (!$res || $res == 0) {
            return false;
        }

        $paramLength = count($matches);
        $keyParams = array();
        for ($i = 0; $i < $paramLength; $i++) {
            $keyParams[$matches[$i]] = $params[$i + 1];
        }

        if(!preg_match('(\d+)', $keyParams[1])){
            throw NotIntegerParamException::empty();
        }

        return $keyParams[1];

    }

    public function match()
    {
        $yaml = Yaml::parseFile(dirname(__FILE__) . '/config/Router.yml');
        
        foreach ($yaml as $route) {
            if ($result = $this->variableExtractor($route['path'])) {
                return $result;
            } 
        }

        throw NotRouteFoundException::empty();

    }
    
}