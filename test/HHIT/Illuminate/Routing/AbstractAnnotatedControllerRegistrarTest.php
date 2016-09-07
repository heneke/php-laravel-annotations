<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2016 Hendrik Heneke
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace HHIT\Illuminate\Routing;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

abstract class AbstractAnnotatedControllerRegistrarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @before
     */
    public function before()
    {
        AnnotationRegistry::registerAutoloadNamespace('HHIT\Illuminate\Routing\Annotation', realpath(__DIR__.'/../../../../src'));
        $this->annotationReader = new AnnotationReader();
        $this->container = new Container();
        $this->router = new Router(new Dispatcher($this->container), $this->container);
    }

    protected function createAndBootRegistrar($className)
    {
        return (new AnnotatedControllerRegistrar($this->annotationReader, $className))->addRoutes($this->router);
    }

    protected function assertRoute($uri, $methods, $name = null, $middlewares = null, $domain = null)
    {
        if ($methods === 'ANY') {
            $methods = AnnotatedControllerRegistrar::$ANY;
        }
        $methods = (array) $methods;

        $route = $this->findRoute($uri, $methods[0]);
        $this->assertNotNull($route, "{$this->getName()}: route '{$uri}' not found");

        if (in_array('GET', $methods) && !in_array('HEAD', $methods)) {
            array_splice($methods, array_search('GET', $methods), 1, ['GET', 'HEAD']);
        }
        $this->assertEquals($methods, $route->getMethods(), "{$this->getName()}: methods differ");

        $this->assertEquals($name, $route->getName(), "{$this->getName()}: name differs");

        if ($middlewares === null) {
            $middlewares = [];
        }
        if (!is_array($middlewares)) {
            $middlewares = [$middlewares];
        }
        $this->assertEquals($middlewares, $route->gatherMiddleware(), "{$this->getName()}: middlewares differ");

        $this->assertEquals($domain, $route->domain(), "{$this->getName()}: domains differ");
    }

    /**
     * @param $uri
     *
     * @return Route|null
     */
    protected function findRoute($uri, $method)
    {
        foreach ($this->router->getRoutes()->getIterator() as $route) {
            /*
             * @var Route
             */
            if ($route->uri() === $uri && in_array($method, $route->getMethods())) {
                return $route;
            }
        }

        return null;
    }
}
