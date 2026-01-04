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

class ome_rpc_response_taoda_delivery
{
    
    /**
     * 前端推送所有平台商品信息接口
     *
     * 
     */
    
    
    function get_finish($result){
        $bns = json_decode($result['bns']);

        $dObj   = app::get('ome')->model('delivery');
        $filter['status'] = 'succ';
        $filter['process'] = 'true';
        $filter['parent_id'] = 0;
        $back = array();

        foreach ($bns as $k => $item){
            $filter['status'] = 'succ';
            $filter['process'] = 'true';
            $filter['parent_id'] = 0;

            $filter['delivery_bn'] = $item;
            $num = 0;
            $dly = $dObj->dump($filter,'delivery_id,delivery_bn,logi_no,logi_name',array('delivery_items'=>array('*')));
            
            $back[$k]['delivery_id'] = $dly['delivery_bn'];
            $back[$k]['logi_no']     = $dly['logi_no'];
            $back[$k]['logi_name']   = $dly['logi_name'];
           
        }

        return $back;
    }
}
?>