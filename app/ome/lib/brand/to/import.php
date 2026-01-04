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

class ome_brand_to_import {

    function run(&$cursor_id,$params,&$errmsg){

        $brandObj = app::get('ome')->model('brand');
        $brandSdf = $params['sdfdata'];

        foreach ($brandSdf as $v){
            $su = array();
            $su['brand_name'] = $v[0];
            $su['brand_url'] = $v[1];
            $su['brand_keywords'] = $v[2];
          
            $brandObj->save($su);
			$m = $brandObj->db->errorinfo();
			if(!empty($m)){
				$errmsg.=$m.";";
			}
         }
         
        return false;
    }
}
