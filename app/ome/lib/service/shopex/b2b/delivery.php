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


class ome_service_shopex_b2b_delivery{
    
    /**
     * 添加发货单
     * @param int $delivery_id 发货单ID
     * @param 引用 $is_request 是否发起请求
     */
    function add($delivery_id,&$is_request){
        //TODO:暂时只返回是否发起请求的标识，发起的数据参数后期完善
        $deliveryObj = app::get('ome')->model('delivery');
        $delivery_detail = $deliveryObj->dump($delivery_id, 'process');
        if ($delivery_detail['process'] == 'true'){
            $is_request = 'true';
        }else{
            $is_request = 'false';
        }
        return NULL;
    }
    
}