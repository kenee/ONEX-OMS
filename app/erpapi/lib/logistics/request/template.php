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
 * @author ykm 2016/6/17
 * @describe 获取模板数据
 */

class erpapi_logistics_request_template extends erpapi_logistics_request_abstract {
    protected $title = '获取打印模板';
    protected $timeOut = 10;
    protected $primaryBn = '';

    #模板获取同一接口
    final protected function requestCall($method,$params,$callback=array())
    {
        return $this->__caller->call($method,$params,$callback,$this->title, $this->timeOut, $this->primaryBn);
    }
}
