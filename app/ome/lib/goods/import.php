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

class ome_goods_import {

    function run(&$cursor_id,$params,&$errmsg){
        $opObj  = app::get('ome')->model('operation_log');
        $log_memo = '批量导入商品';
		 foreach($params['sdfdata'] as $v){
			$mdl = app::get($params['app'])->model($params['mdl']);
            if(!$mdl->save($v)){
			$m = $mdl->db->errorinfo();
			kernel::log("errmsg = ".$m);
			if(!empty($m)){		
				$errmsg.=$m.";";
			}
			}
			$opObj->write_log('goods_import@ome', $v['goods_id'], $log_memo,'',$params['opinfo']);
        }
        return false;
	}
}