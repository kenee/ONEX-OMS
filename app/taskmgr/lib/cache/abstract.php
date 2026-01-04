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
 * 导出数据存储基类
 *
 * @author kamisama.xia@gmail.com
 * @version 0.1
 */

abstract class taskmgr_cache_abstract {

    //saas定义的是用户域名
    private function kvprefix() {
        return (defined('KV_PREFIX')) ? KV_PREFIX : 'default';
    }

    public function create_key($key) 
    {
        return md5($this->kvprefix() . $key);
    }
}