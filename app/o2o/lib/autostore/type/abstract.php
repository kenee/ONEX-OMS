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

abstract class o2o_autostore_type_abstract{
    
    /**
     * 规则类型
     * 
     * @var Array
     */
    protected $type;

    /**
     * 获取TmplConf
     * @return mixed 返回结果
     */
    public function getTmplConf(){
        return $this->config['tmpl'];
    }
}