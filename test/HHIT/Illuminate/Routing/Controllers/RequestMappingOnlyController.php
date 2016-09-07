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

use HHIT\Illuminate\Routing\Annotation\RequestMapping;

class RequestMappingOnlyController
{
    /**
     * @RequestMapping(uri="/only/get", method="GET")
     */
    public function get()
    {
    }

    /**
     * @RequestMapping(uri="/only/any", method="ANY")
     */
    public function any()
    {
    }

    /**
     * @RequestMapping(uri="/only/options", method="OPTIONS")
     */
    public function options()
    {
    }

    /**
     * @RequestMapping(uri="/only/post", method="POST")
     */
    public function post()
    {
    }

    /**
     * @RequestMapping(uri="/only/put", method="PUT")
     */
    public function put()
    {
    }

    /**
     * @RequestMapping(uri="/only/delete", method="DELETE")
     */
    public function delete()
    {
    }

    /**
     * @RequestMapping(uri="/only/patch", method="PATCH")
     */
    public function patch()
    {
    }

    /**
     * @RequestMapping(uri="/", method="GET")
     */
    public function get_slash()
    {
    }

    /**
     * @RequestMapping(uri="", method="POST")
     */
    public function post_empty()
    {
    }

    /**
     * @RequestMapping(uri="/get_middleware", method="GET", middleware="methodMiddleware")
     */
    public function get_middleware()
    {
    }

    /**
     * @RequestMapping(uri="/get_name", method="GET", name="get_name")
     */
    public function get_name()
    {
    }

    /**
     * @RequestMapping(uri="/get_domain", method="GET", domain="get.domain.com")
     */
    public function get_domain()
    {
    }

    /**
     * @RequestMapping(uri="/get_all", method="GET", name="get_all", middleware="allMiddleware", domain="all.domain.com")
     */
    public function all()
    {
    }
}
