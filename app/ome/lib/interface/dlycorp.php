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

class ome_interface_dlycorp{

    function __construct($app){
        $this->app = $app;
    }

    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null){
        return $this->app->model('dly_corp')->getList($cols, $filter, $offset, $limit, $orderType);
    }

    public function count($filter=array()){
        return $this->app->model('dly_corp')->count($filter);
    }

    /**
     * 保存
     * @param mixed $data 数据
     * @return mixed 返回操作结果
     */
    public function save(&$data){
        if(!$data){
            return false;
        }
        return $this->app->model('dly_corp')->save($data);
    }

    /**
     * 更新
     * @param mixed $data 数据
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function update($data, $filter){
        return $this->app->model('dly_corp')->update($data,$filter);
    }

    /**
     * 删除
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function delete($filter){
        return $this->app->model('dly_corp')->delete($filter);
    }
}