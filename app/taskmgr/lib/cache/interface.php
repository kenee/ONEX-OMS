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
 * 导出数据存储的接口定义
 *
 * @author kamisama.xia@gmail.com
 * @version 0.1
 */
interface taskmgr_cache_interface {

    /**
     * 查询存储的数据内容 
     * 
     * @param string $key 唯一键
     * @param string $content 存储的数据内容
     * @return void
     */
    public function fetch($key, &$content);

    /**
     * 保存存储的数据内容 
     * 
     * @param string $key 唯一键
     * @param string $content 存储的数据内容
     * @param int $ttl 过期时间
     * @return void
     */
    public function store($key, $content, $ttl);

    /**
     * 追加存储数据
     * 
     * @param string $key 唯一键
     * @param string $content 存储的数据内容
     * @param int $ttl 过期时间
     * @return void
     */
    /*
    public function append($key, $content, $ttl);
    */

    /**
     * 删除存储数据
     * 
     * @param string $key 唯一键
     * @return void
     */
    public function delete($key);

    /**
     * 计数器
     * 
     * @param string $key 唯一键
     * @return void
     */
    public function increment($key);

}