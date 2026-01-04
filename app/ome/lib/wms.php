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

class ome_wms{

   public static  $wms_status = array(
      
        'ready'    => array('10','20','30'),
        'succ'     =>array('40'),
        
    );



    /**
     * notify
     * @param mixed $delivery_id ID
     * @return mixed 返回值
     */
    public function notify($delivery_id){

       
       
        ome_delivery_notice::notify($delivery_id);
            
        
    }

    /**
     * 获取PlatformBranchs
     * @param mixed $branch_id ID
     * @param mixed $type type
     * @return mixed 返回结果
     */
    public function getPlatformBranchs($branch_id,$type){

        $branchs = app::get('ome')->model('branch_relation')->dump(array ('branch_id'=>$branch_id,'type' => $type));
        return $branchs;
    }

    /**
     * 获取Platform
     * @param mixed $type type
     * @return mixed 返回结果
     */
    public function getPlatform($type){

        $branchs = app::get('ome')->model('branch_relation')->dump(array('type' => $type));
        return $branchs;
    }
}