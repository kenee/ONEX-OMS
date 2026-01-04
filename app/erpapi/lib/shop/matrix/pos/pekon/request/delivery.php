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

define("POS_LOGISTICS_ONLINE_SEND",'orderDeliveryUpdate');
class erpapi_shop_matrix_pos_pekon_request_delivery extends erpapi_shop_matrix_pos_request_delivery
{
   
   

   protected function get_confirm_params($sdf){

      
        $param = array(
            'api'                   => 'orderDeliveryUpdate',
            'orderNo'               => $sdf['orderinfo']['order_bn'], // 订单号
            'deliveryCompanyCode'   => $sdf['logi_type'], // 物流编号
            'deliveryCompanyName'   => $sdf['logi_name'], // 物流公司
            'deliveryCode'          => $sdf['logi_no'], // 运单号
            'warehouseCode'         => $sdf['branch_bn'],
        );
        

        $orderItems = [];
        $sdf['delivery_items'] = array_values($sdf['delivery_items']);
        foreach($sdf['delivery_items'] as $k=>$v){
            $oid = $v['oid'];
            $oid = $oid ? list($itemoid,$seqno)=explode('_',$oid) : '';
            $uniqueCodes = [];
            if($v['uniqueCodes']){
                foreach($v['uniqueCodes'] as $sv){
                    $uniqueCodes[]['uniqueCode'] = $sv;
                }
                
            }
            $items = array(

                'itemSeqNo' =>  $seqno,
                'skuCode'   =>  $v['bn'],
                'quantity'  =>  $v['number'],

            );
            if($uniqueCodes) $items['uniqueCodes'] = $uniqueCodes;
            $orderItems[] = $items;
        }
        $param['orderItems'] = $orderItems;

        return $param;
    }


    /**
     * confirm
     * @param mixed $sdf sdf
     * @param mixed $queue queue
     * @return mixed 返回值
     */
    public function confirm($sdf, $queue = false)
    {

        // 只处理已发货与部分发货状态
        if ($sdf['status'] != 'succ' && !in_array($sdf['orderinfo']['ship_status'], array('1', '2'))) return $this->succ('发货单未发货');

        $this->format_confirm_sdf($sdf);

        // 发货记录
        $opInfo = kernel::single('ome_func')->getDesktopUser();
        $log_id = uniqid($_SERVER['HOSTNAME']);
        $log = array(
            'shopId'           => $this->__channelObj->channel['shop_id'],
            'ownerId'          => $opInfo['op_id'],
            'orderBn'          => $sdf['orderinfo']['order_bn'],
            'deliveryCode'     => $sdf['logi_no'],
            'deliveryCropCode' => $sdf['logi_type'],
            'deliveryCropName' => $sdf['logi_name'],
            'receiveTime'      => time(),
            'status'           => 'send',
            'updateTime'       => '0',
            'message'          => '',
            'log_id'           => $log_id,
        );

        $shipmentLogModel = app::get('ome')->model('shipment_log');
        $shipmentLogModel->insert($log);

        // 更新订单状态
        $orderModel = app::get('ome')->model('orders');
        $orderModel->update(array('sync' => 'run'), array('order_id' => $sdf['orderinfo']['order_id']));

        // 整理参数格式
        $title = sprintf('发货状态回写[%s]-%s', $sdf['delivery_bn'], $this->__channelObj->channel['node_type']);

        $params = $this->get_confirm_params($sdf);


        $callback = array();
        $callbackParams = array(
            'shipment_log_id' => $log_id,
            'order_id' => $sdf['orderinfo']['order_id'],
            'logi_no' => $sdf['logi_no'],
            'obj_bn' => $sdf['orderinfo']['order_bn'],
            'company_code' => $sdf['logi_type'],
        );
        
        $result = $this->__caller->call($this->get_delivery_apiname($sdf), $params, $callback, $title, 10, $sdf['orderinfo']['order_bn']);

        // 直连情况下,执行callback函数
        $this->confirm_callback($result, $callbackParams);
        return $result;
    }

    /**
     * 发货回调
     *
     * @return void
     * @author
     **/
    public function confirm_callback($response, $callback_params)
    {
        $rs = parent::confirm_callback($response, $callback_params);
        return $rs;
    }
    
}