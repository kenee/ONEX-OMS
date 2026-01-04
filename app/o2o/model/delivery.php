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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2022/6/6 10:20:10
 * @describe: model层
 * ============================
 */
class o2o_mdl_delivery extends dbeav_model {

    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */

    public function table_name($real=false)
    {
        $table_name = 'delivery';
        if($real){
            return DB_PREFIX.'wap_'.$table_name;
        }else{
            return $table_name;
        }
    }

    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema(){
        return app::get('wap')->model('delivery')->get_schema();
    }
}