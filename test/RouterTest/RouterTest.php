<?php

namespace RouterTest;

use PHPUnit;
use Router\Router;
use Router\Exception\{NotRouteFoundException, NotIntegerParamException};

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
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }

    /** @test */
    public function shouldNotMatchRouteIfParamNotInteger()
    {
        $router = new Router('/post/aaa/');
        $this->expectException(NotIntegerParamException::class);
        $router->match();
    }

    /** @test */
    public function shouldNotMatchRouteIfTooManyParams()
    {
        $router = new Router('/post/aaa/bbb/1/');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }
    
    /** @test */
    public function shouldNotMatchRouteIfNoParams()
    {
        $router = new Router('/post/');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }
    
    /** @test */
    public function shouldNotMatchRouteIfEmpty()
    {
        $router = new Router('');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }

}