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

class console_wms_delivery
{
    /**
     * retryWmsDelivery
     * @param mixed $id ID
     * @return mixed 返回值
     */
    public function retryWmsDelivery($id)
    {
        $deliveryData = $this->formatDeliveryData($id);
        
        $node_id = $deliveryData['node_id'];
        $method = 'wms.delivery.status_update';
        
        //response
        $result = kernel::single('erpapi_router_response')->set_node_id($node_id)->set_api_name($method)->dispatch($deliveryData);
        print_r($result);
    }
    
    /**
     * formatDeliveryData
     * @param mixed $id ID
     * @return mixed 返回值
     */
    public function formatDeliveryData($id)
    {
        $wdMdl = app::get('console')->model('wms_delivery');

        $deliverys = $wdMdl->dump(array('id'=>$id),'*');

        if(empty($deliverys)) return true;
        
        $wdMdl->update(array('delivery_status'=>'2'),array('id'=>$id));
        
        $inData = [];
        $inData['delivery_bn'] = $deliverys['delivery_bn'];
        $inData['out_delivery_bn'] = $deliverys['out_delivery_bn'];
        $inData['status'] = $deliverys['wms_status'];
        $inData['node_id'] = $deliverys['wms_node_id'];
        $inData['logistics'] = $deliverys['logistics'];
        $inData['logi_no'] = $deliverys['logi_no'];
        $inData['weight'] = $deliverys['weight'];
        $inData['remark'] = $deliverys['remark'];
        $inData['volume'] = $deliverys['volume'];
        $inData['extend_props'] = $deliverys['extend_props'];
        $inData['operate_time'] = $deliverys['operate_time'];
        $inData['warehouse'] = $deliverys['warehouse'];
        $inData['oid'] = $deliverys['oid'];
        $inData['other_list_0'] = $deliverys['other_list_0'];
        $inData['packages'] = $deliverys['packages'];
        
        return $inData;
    }



   
}

