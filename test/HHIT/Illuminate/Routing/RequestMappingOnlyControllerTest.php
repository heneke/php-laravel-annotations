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

use HHIT\Illuminate\Routing\Controllers\RequestMappingOnlyController;

class RequestMappingOnlyControllerTest extends AbstractAnnotatedControllerRegistrarTest
{
    /**
     * @before
     */
    public function before()
    {
        parent::before();
        $this->createAndBootRegistrar(RequestMappingOnlyController::class);
    }

    /**
     * @test
     */
    public function method_get()
    {
        $this->assertRoute('only/get', ['GET', 'HEAD']);
    }

    /**
     * @test
     */
    public function method_any()
    {
        $this->assertRoute('only/any', 'ANY');
    }

    /**
     * @test
     */
    public function method_options()
    {
        $this->assertRoute('only/options', 'OPTIONS');
    }

    /**
     * @test
     */
    public function method_post()
    {
        $this->assertRoute('only/post', 'POST');
    }

    /**
     * @test
     */
    public function method_put()
    {
        $this->assertRoute('only/put', 'PUT');
    }

    /**
     * @test
     */
    public function method_delete()
    {
        $this->assertRoute('only/delete', 'DELETE');
    }

    /**
     * @test
     */
    public function method_patch()
    {
        $this->assertRoute('only/patch', 'PATCH');
    }

    /**
     * @test
     */
    public function method_get_slash()
    {
        $this->assertRoute('/', 'GET');
    }

    /**
     * @test
     */
    public function method_post_slash()
    {
        $this->assertRoute('/', 'POST');
    }

    /**
     * @test
     */
    public function only_middleware()
    {
        $this->assertRoute('get_middleware', 'GET', null, 'methodMiddleware');
    }

    /**
     * @test
     */
    public function only_name()
    {
        $this->assertRoute('get_name', 'GET', 'get_name');
    }

    /**
     * @test
     */
    public function only_domain()
    {
        $this->assertRoute('get_domain', 'GET', null, null, 'get.domain.com');
    }

    /**
     * @test
     */
    public function only_all()
    {
        $this->assertRoute('get_all', 'GET', 'get_all', 'allMiddleware', 'all.domain.com');
    }
}
