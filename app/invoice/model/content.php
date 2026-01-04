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
 +----------------------------------------------------------
 * 发票内容管理 model
 +----------------------------------------------------------
 * Time: 2016-05-31 
 +----------------------------------------------------------
 */
class invoice_mdl_content extends dbeav_model{
    
    var $defaultOrder = array('content_id',' asc');
    
    //选择了商品明细 无法进行删除操作
    public function pre_recycle($rows){       
        $flag = true;
        $arr_content_ids = array();
        $rl_content = array();
        
        foreach ($rows as $var){
            if(intval($var["content_id"]) == 1){
                $flag = false;
                break;
            }
            $rl_content[$var["content_id"]] = $var["content_name"];
        }
        if(!$flag){
            $this->recycle_msg = '商品明细必须存在 ，无法进行删除！';
            return false;
        }
        $obj_orders = app::get('invoice')->model('order');
        foreach($rl_content as $val){
           $rs = $obj_orders->count(array('content'=>$val));
           if($rs>=1){
             $this->recycle_msg = $val.'，已被应用，无法进行删除！';
             return false;
           }
        }
        return true;
    }
    
}