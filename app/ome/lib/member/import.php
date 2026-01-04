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

class ome_member_import {

    function run(&$cursor_id,$params,&$errmsg){
        $memberObj = app::get('ome')->model('members');

        foreach($params['sdfdata'] as $v){
			
            $uname = $v['uname'];
            $shopex_shop_type = ome_shop_type::shopex_shop_type();
            if(in_array($v['shop_type'],$shopex_shop_type)){
                $member_detail = $memberObj->dump(array('uname'=>$uname,'shop_id'=>$v['shop_id']),'member_id');
            }else{
                $member_detail = $memberObj->dump(array('uname'=>$uname,'shop_type'=>$v['shop_type']),'member_id');
            }
            
            if(!$member_detail['member_id']){
                kernel::single('ome_member_func')->save($v,$v['shop_id']);
            }
        }
        return false;
    }
}