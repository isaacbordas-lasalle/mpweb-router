<?php

namespace Router;

use Symfony\Component\Yaml\Yaml;
use Exception;

class Router
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
        if($this->match()) {
            print "Ok";
        }

    }

    public function isNumericParameter()
    {
        $param = end(explode('/', trim($this->uri, '/')));
        
        if(preg_match('(\d+)', $param)){
            return true;
        }
        
        return false;
    }
    
    public function match()
    {
        $yaml = Yaml::parseFile(dirname(__FILE__) . '/config/Router.yml');
        
        foreach ($yaml as $route) {
            print $this->uri;
            if ($route['path'] == $this->uri) {
                return true;
            } 
        }
        
        return false;

    }
    
}