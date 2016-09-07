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
use HHIT\Illuminate\Routing\Annotation\Controller;
use HHIT\Illuminate\Routing\Annotation\RequestMapping;
use Illuminate\Routing\Router;

class AnnotatedControllerRegistrar
{
    public static $ANY = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE'];

    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    /**
     * @var \ReflectionClass
     */
    private $reflectionClass;

    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var RequestMapping[]
     */
    private $requestMappings = [];

    public function __construct(AnnotationReader $annotationReader, $className)
    {
        $this->annotationReader = $annotationReader;
        if (!$className) {
            throw new \InvalidArgumentException('Class name required!');
        }
        if (!is_string($className)) {
            throw new \InvalidArgumentException('Class name must be of type string!');
        }
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Class {$className} does not exist!");
        }
        $this->reflectionClass = new \ReflectionClass($className);
        $this->read();
    }

    private function read()
    {
        $this->controller = $this->annotationReader->getClassAnnotation($this->reflectionClass, Controller::class);

        foreach ($this->reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            $requestMapping = $this->annotationReader->getMethodAnnotation($reflectionMethod, RequestMapping::class);
            if ($requestMapping) {
                $this->requestMappings[$this->getUses($reflectionMethod)] = $requestMapping;
            }
        }
    }

    public function addRoutes(Router $router)
    {
        if ($this->controller !== null) {
            if ($this->controller->prefix !== null) {
                $router->group(['prefix' => $this->controller->prefix, 'middleware' => $this->controller->middleware], function (Router $router) {
                    $this->addMethodRoutes($router);
                });
            } else {
                $router->group(['middleware' => $this->controller->middleware], function (Router $router) {
                    $this->addMethodRoutes($router);
                });
            }
        } else {
            $this->addMethodRoutes($router);
        }

        return $this;
    }

    protected function addMethodRoutes(Router $router)
    {
        foreach ($this->requestMappings as $uses => $requestMapping) {
            /*
             * @var $requestMapping RequestMapping
             */
            $uri = trim($requestMapping->uri, '/');
            $routerMethod = strtolower($requestMapping->method);
            $router->$routerMethod($uri, ['as' => $requestMapping->name, 'uses' => $uses, 'domain' => $requestMapping->domain])->middleware($requestMapping->middleware);
        }
    }

    private function getUses(\ReflectionMethod $method)
    {
        return sprintf('%1$s@%2$s', $this->reflectionClass->getName(), $method->getName());
    }
}
