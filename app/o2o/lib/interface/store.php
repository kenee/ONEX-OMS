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

class o2o_interface_store{

    function __construct($app){
        $this->app = $app;
    }

    /**
     * dump
     * @param mixed $filter filter
     * @param mixed $fields fields
     * @return mixed 返回值
     */
    public function dump($filter, $fields){
        $storeObj = $this->app->model('store');
        return $storeObj->dump($filter, $fields);
    }
}