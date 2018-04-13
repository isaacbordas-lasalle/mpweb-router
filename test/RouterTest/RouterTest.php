<?php

namespace RouterTest;

use PHPUnit;
use Router\Router;

class RouterTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    public function shouldMatchRoute()
    {
        $router = new Router('/post/1/');
        $result = $router->match();
        $this->assertEquals(1, $result, 'shouldMatchRoute');
    }

    /** @test */
    public function shouldNotMatchRouteIfMissingFinalSlash()
    {
        $router = new Router('/post/1');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteIfMissingFinalSlash');
    }

    /** @test */
    public function shouldNotMatchRouteIfParamNotInteger()
    {
        $router = new Router('/post/aaa/');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteIfParamNotInteger');
    }

    /** @test */
    public function shouldNotMatchRouteIfTooManyParams()
    {
        $router = new Router('/post/aaa/bbb/1/');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteIfTooManyParams');
    }
    
    /** @test */
    public function shouldNotMatchRouteIfNoParams()
    {
        $router = new Router('/post/');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteIfNoParams');
    }
    
    /** @test */
    public function shouldNotMatchRouteIfEmpty()
    {
        $router = new Router('');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteIfEmpty');
    }

}