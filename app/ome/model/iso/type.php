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

class ome_mdl_iso_type extends dbeav_model {

    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */
    public function table_name($real=false)
    {
        $table_name = 'iostock_type';
        if($real){
            return DB_PREFIX.'siso_'.$table_name;
        }else{
            return $table_name;
        }
    }
    
    //确定表结构
    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema(){
        return app::get('siso')->model('iostock_type')->get_schema();
    }
}