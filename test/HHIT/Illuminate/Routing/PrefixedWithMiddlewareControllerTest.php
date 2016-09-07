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

use HHIT\Illuminate\Routing\Controllers\PrefixedWithMiddlewareController;

class PrefixedWithMiddlewareControllerTest extends AbstractAnnotatedControllerRegistrarTest
{
    /**
     * @before
     */
    public function before()
    {
        parent::before();
        $this->createAndBootRegistrar(PrefixedWithMiddlewareController::class);
    }

    /**
     * @test
     */
    public function prefixedmw_get()
    {
        $this->assertRoute('prefixed/get', 'GET', null, 'ctrMiddleware');
    }

    /**
     * @test
     */
    public function prefixedmw_middleware_get()
    {
        $this->assertRoute('prefixed/get_middleware', 'GET', null, ['ctrMiddleware', 'methodMiddleware']);
    }

    /**
     * @test
     */
    public function prefixedmw_name_get()
    {
        $this->assertRoute('prefixed/get_name', 'GET', 'get_name', 'ctrMiddleware');
    }

    /**
     * @test
     */
    public function prefixedmw_domain_get()
    {
        $this->assertRoute('prefixed/get_domain', 'GET', null, 'ctrMiddleware', 'some.domain.com');
    }

    /**
     * @test
     */
    public function prefixedmw_get_all()
    {
        $this->assertRoute('prefixed/get_all', 'GET', 'get_all', ['ctrMiddleware', 'methodMiddleware'], 'some.domain.com');
    }
}
