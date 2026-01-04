<?php
/**
 * Copyright 2026 ShopeX (https://www.shopex.cn)
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
 * 获取平台基础信息
 *
 * @author wangbiao@shopex.cn
 * @version 2024.03.07
 */
class erpapi_shop_request_base extends erpapi_shop_request_abstract
{
    /**
     * 获取京东Token信息
     * 
     * @param $params
     * @return array
     */

    public function getNpsToken($params=null)
    {
        $error_msg = '平台未对接';
        $msgcode = '304';
        
        return $this->error($error_msg, $msgcode);
    }

    /**
     * 获取pdd 前端检测插件的初始化code
     * @Author: XueDing
     * @Date: 2024/12/4 2:32 PM
     * @param $params
     * @return array
     */
    public function getPageCode($params = [])
    {
        return $this->succ('暂无请求');
    }
}