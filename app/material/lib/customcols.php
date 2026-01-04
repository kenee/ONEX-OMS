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

class material_customcols{

    /**
     * 获取cols
     * @return mixed 返回结果
     */
    public function getcols(){

        $customcolsMdl = app::get('desktop')->model('customcols');

        $customcolslist = $customcolsMdl->getlist('col_name,col_key',array('tbl_name'=>'sdb_material_basic_material'));

        if($customcolslist){

            
            return $customcolslist;
        }
    }


    /**
     * 获取colstemplate
     * @return mixed 返回结果
     */
    public function getcolstemplate(){

        $cols = $this->getcols();
        $coltemp = array();
        foreach($cols as $v){

            $key = '*:'.$v['col_name'];
            $name = 'custom/'.$v['col_key'];

            $coltemp[$key] = $name;
        }

        return $coltemp;
    }

}