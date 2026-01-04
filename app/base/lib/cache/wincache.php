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


/*
 * @package base
 * @copyright Copyright (c) 2010, shopex. inc
 * @author edwin.lzh@gmail.com
 * @license 
 */
class base_cache_wincache extends base_cache_abstract implements base_interface_cache 
{

    function __construct() 
    {
        $this->check_vary_list();
    }//End Function

    /**
     * fetch
     * @param mixed $key key
     * @param mixed $result result
     * @return mixed 返回值
     */
    public function fetch($key, &$result) 
    {
        $result = wincache_ucache_get($key, $return);
        return $return;
    }//End Function

    /**
     * store
     * @param mixed $key key
     * @param mixed $value value
     * @param mixed $ttl ttl
     * @return mixed 返回值
     */
    public function store($key, $value, $ttl) 
    {
        return wincache_ucache_set($key, $value, $ttl);
    }//End Function

    /**
     * status
     * @return mixed 返回值
     */
    public function status() 
    {
        $status = wincache_ucache_info(true);
        $return['缓存命中'] = $status['total_hit_count'];
        $return['缓存未命中'] = $status['total_miss_count'];
        return $return;
    }//End Function

}//End Class