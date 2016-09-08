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

namespace HHIT\Illuminate\Routing\Controllers;

use HHIT\Illuminate\Routing\Annotation\Controller;
use HHIT\Illuminate\Routing\Annotation\RequestMapping;

/**
 * @Controller(prefix="prefixed")
 */
class PrefixedController
{
    /**
     * @RequestMapping(uri="/get", method="GET")
     */
    public function get()
    {
    }

    /**
     * @RequestMapping(uri="/get_middleware", method="GET", middleware="methodMiddleware")
     */
    public function get_middlware()
    {
    }

    /**
     * @RequestMapping(uri="/get_name", method="GET", name="get_name")
     */
    public function get_name()
    {
    }

    /**
     * @RequestMapping(uri="/get_domain", method="GET", domain="some.domain.com")
     */
    public function get_domain()
    {
    }

    /**
     * @RequestMapping(uri="/get_all", method="GET", name="get_all", domain="some.domain.com", middleware="allMiddleware")
     */
    public function get_all()
    {
    }
}
