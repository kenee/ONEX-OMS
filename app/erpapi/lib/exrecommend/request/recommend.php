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

#智选物流(快递鸟和菜鸟智选物流)
class erpapi_exrecommend_request_recommend extends erpapi_exrecommend_request_abstract{
    #智选物流请求统一出口
    final protected function requestCall($method,$params,$callback=array(),$orign_params=array())
    {
        if(!$this->title) {
            $this->title = '获取智选物流';
        }
        return $this->__caller->call($method,$params,$callback,$this->title, $this->timeOut, $this->primaryBn);
    }
}