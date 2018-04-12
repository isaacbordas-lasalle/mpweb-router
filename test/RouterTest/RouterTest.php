<?php

namespace RouterTest;

use PHPUnit;
use Router\Router;

class RouterTest extends PHPUnit\Framework\TestCase
{

    protected function tearDown()
    {
        $router = NULL;
    }

    /** @test */
    public function shouldMatchRoute()
    {
        $router = new Router('/post/1/');
        $result = $router->match();
        $this->assertEquals(1, $result, 'shouldMatchRoute');
    }

    /** @test */
    public function shouldNotMatchRouteByMissingFinalSlash()
    {
        $router = new Router('/post/1');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteByMissingFinalSlash');
    }

    /** @test */
    public function shouldNotMatchRouteByParamNotInteger()
    {
        $router = new Router('/post/aaa/');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteByParamNotInteger');
    }

    /** @test */
    public function shouldNotMatchRouteByTooManyParams()
    {
        $router = new Router('/post/aaa/bbb/1/');
        $result = $router->match();
        $this->assertEquals(0, $result, 'shouldNotMatchRouteByTooManyParams');
    }

}