<?php

namespace Router;

use Exception;

class Router
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
        print $this->uri;
        print $this->extractParam();
        $this->checkParam();
    }

    public function extractParam()
    {

        $param = end(explode('/', trim($this->uri, '/')));

        return $param;
    }

    public function checkParam()
    {
        if(preg_match('(\d+)', $this->extractParam())){
            print 'Es num';
        } else {
            print 'No es num';
        }
    }
}