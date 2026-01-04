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
/**
 * @Author: xueding@shopex.cn
 * @Datetime: 2022/4/18
 * @Describe: 外部erp接口白名单
 */
class erpapi_dchain_whitelist
{
    private $whiteList;
    
    /**
     * __construct
     * @return mixed 返回值
     */

    public function __construct()
    {
        $this->whiteList = array(
            'taobao' => $this->taobao,
        );
    }
    
    /**
     * 获取WhiteList
     * @param mixed $nodeType nodeType
     * @return mixed 返回结果
     */
    public function getWhiteList($nodeType)
    {
        return $this->whiteList[$nodeType] ? array_merge($this->whiteList[$nodeType],
            $this->public_api) : $this->public_api;
    }
    
    #共有接口
    private $public_api = array();
    
    /**
     * 淘宝 RPC服务接口名列表
     * @access private
     */
    private $taobao = array();
}
