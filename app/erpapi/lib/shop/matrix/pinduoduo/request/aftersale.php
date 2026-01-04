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
 * 拼多多店铺退货业务请求Lib类
 */
class erpapi_shop_matrix_pinduoduo_request_aftersale extends erpapi_shop_request_aftersale
{
    /**
     * [换货]卖家确认收货
     */

    public function consignGoods($data){
        $title = '店铺('.$this->__channelObj->channel['name'].')换货订单卖家发货,(售后单号:'.$data['dispute_id'].')';
    
        $params = array(
            'dispute_id'             => $data['dispute_id'],
            'tid'                    => $data['platform_order_bn']? $data['platform_order_bn'] : $data['relate_order_bn'],
            'logistics_no'           => $data['logistics_no'],
            'corp_type'              => $data['corp_type'],
            'logistics_company_name' => $data['logistics_company_name'],
        );
        $result = $this->__caller->call(SHOP_EXCHANGE_CONSIGNGOODS, $params, array(), $title, 10, $data['order_bn']);
        if(isset($result['msg']) && $result['msg']){
            $rs['msg'] = $result['msg'];
        }elseif(isset($result['err_msg']) && $result['err_msg']){
            $rs['msg'] = $result['err_msg'];
        }elseif(isset($result['res']) && $result['res']){
            $rs['msg'] = $result['res'];
        }
        $rs['rsp'] = $result['rsp'];
        
        
        $rs['data'] = $result['data'] ? $result['data'] : array();
        // 发货记录
        
        $log_id = uniqid($_SERVER['HOSTNAME']);
        $status = ($rs['rsp']=='succ') ? 'succ' : 'fail';
        $log = array(
            'shopId'           => $this->__channelObj->channel['shop_id'],
            'ownerId'          => '16777215',
            'orderBn'          => $data['order_bn'],
            'deliveryCode'     => $params['logistics_no'],
            'deliveryCropCode' => $params['corp_type'],
            'deliveryCropName' => $params['logistics_company_name'],
            'receiveTime'      => time(),
            'status'           => $status,
            'updateTime'       => time(),
            'message'          => $rs['msg'] ? $rs['msg'] : '成功',
            'log_id'           => $log_id,
        );
        
        $shipmentLogModel = app::get('ome')->model('shipment_log');
        $shipmentLogModel->insert($log);
        if ($data['order_id']){
            $orderModel    = app::get('ome')->model('orders');
            
            $updateOrderData = array(
                'sync'           => $status,
                'up_time'        => time(),
            
            );
            $orderModel->update($updateOrderData,array('order_id'=>$data['order_id'],'sync|noequal'=>'succ'));
        }
        return $rs;
    }
    
    /**
     * returnGoodsAgree
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function returnGoodsAgree($data){
        $title = '店铺('.$this->__channelObj->channel['name'].')确认收货,(售后单号:'.$data['dispute_id'].')';
        
        $this->__caller->call(SHOP_EXCHANGE_RETURNGOODS_AGREE, $data, array(), $title, 10, $data['dispute_id']);
    }
}
