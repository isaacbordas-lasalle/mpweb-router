<?php

namespace RouterTest;

use PHPUnit\Framework\TestCase;
use Router\Router;
use Router\Exception\{NotRouteFoundException, NotIntegerParamException, EmptyUriException};

class RouterTest extends TestCase
{

    /** @test */
    public function shouldMatchRoute()
    {
        $router = new Router('/post/1/');
        $result = $router->match();
        $this->assertEquals(1, $result, 'shouldMatchRoute');
    }

    /** @test */
    public function shouldThrowNotRouteFoundExceptionIfMissingFinalSlash()
    {
        $router = new Router('/post/1');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }

    /** @test */
    public function shouldThrowNotIntegerParamExceptionIfParamNotInteger()
    {
        $router = new Router('/post/aaa/');
        $this->expectException(NotIntegerParamException::class);
        $router->match();
    }

    /** @test */
    public function shouldThrowNotRouteFoundExceptionIfTooManyParams()
    {
        $router = new Router('/post/aaa/bbb/1/');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }
    
    /** @test */
    public function shouldThrowNotRouteFoundExceptionIfNoParams()
    {
        $router = new Router('/post/');
        $this->expectException(NotRouteFoundException::class);
        $router->match();
    }
    
    /** @test */
    public function shouldThrowEmptyUriExceptionIfEmpty()
    {
        $router = new Router('');
        $this->expectException(EmptyUriException::class);
        $router->match();
    }

}