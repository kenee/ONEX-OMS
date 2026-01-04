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
 * 基础物料唯一码Lib类
 *
 * @author kamisama.xia@gmail.com
 * @version 0.1
 */
class material_serial{

    /**
     * 
     * 检查基础物料是否是唯一码类型
     * @param Int $id 基础物料ID
     */

    public function checkSerialById($id){
        $basicMConfObj    = app::get('material')->model('basic_material');
        $basicInfo = $basicMConfObj->dump(array('bm_id'=>$id, 'serial_number'=>'true'), 'bm_id');
        return $basicInfo ? true : false;
    }
}