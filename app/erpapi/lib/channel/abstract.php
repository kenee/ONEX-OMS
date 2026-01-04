<?php
/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

abstract class erpapi_channel_abstract
{
    /**
     * 路由 matrix|openapi|prism
     *
     * @var string
     **/
    protected $__adapter = '';


    /**
     * 请求平台
     *
     * @var string
     **/
    protected $__platform = '';
    protected $__platform_business = '';

    /**
     * 平台版本
     *
     * @var string
     **/
    protected $__ver = '1';

    /**
     * 
     *
     * @return void
     * @author 
     **/
    public function get_adapter()
    {
        return $this->__adapter;
    }

    /**
     * 请求平台
     *
     * @return void
     * @author 
     **/
    public function get_platform()
    {
        return $this->__platform;
    }
    /**
     * 请求平台业务
     *
     * @return void
     * @author 
     **/
    public function get_platform_business()
    {
        return (string)$this->__platform_business;
    }

    /**
     * 版本号
     *
     * @return void
     * @author 
     **/
    public function get_ver()
    {
        return $this->__ver;
    }

    /**
     * 初始化请求配置
     *
     * @return void
     * @author 
     **/
    abstract public function init($node_id,$channel_id);
}