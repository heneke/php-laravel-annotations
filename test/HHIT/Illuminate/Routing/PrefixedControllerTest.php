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

use HHIT\Illuminate\Routing\Controllers\PrefixedController;

class PrefixedControllerTest extends AbstractAnnotatedControllerRegistrarTest
{
    /**
     * @before
     */
    public function before()
    {
        parent::before();
        $this->createAndBootRegistrar(PrefixedController::class);
    }

    /**
     * @test
     */
    public function prefixed_get()
    {
        $this->assertRoute('prefixed/get', 'GET');
    }

    /**
     * @test
     */
    public function prefixed_middleware_get()
    {
        $this->assertRoute('prefixed/get_middleware', 'GET', null, 'methodMiddleware');
    }

    /**
     * @test
     */
    public function prefixed_name_get()
    {
        $this->assertRoute('prefixed/get_name', 'GET', 'get_name');
    }

    /**
     * @test
     */
    public function prefixed_domain_get()
    {
        $this->assertRoute('prefixed/get_domain', 'GET', null, null, 'some.domain.com');
    }

    /**
     * @test
     */
    public function prefixed_get_all()
    {
        $this->assertRoute('prefixed/get_all', 'GET', 'get_all', 'allMiddleware', 'some.domain.com');
    }
}
