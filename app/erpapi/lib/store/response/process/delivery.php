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

/**
 * 门店发货单响应处理类
 *
 * @author xiayuanjun@shopex.cn
 * @version 0.1
 *
 */
class erpapi_store_response_process_delivery
{
    /**
     * 发货单
     * @param Array $params=array(
     *                  'status'=>@状态@ delivery 
     *                  'delivery_bn'=>@发货单号@
     *                  'out_delivery_bn'=>@外部发货单号@
     *                  'logi_no'=>@运单号@
     *                  'delivery_time'=>@发货时间@
     *                  'weight'=>@重量@
     *                  'delivery_cost_actual'=>@物流费@
     *                  'logi_id'=>@物流公司编码@
     *                  ===================================
     *                  'status'=>print,
     *                  'delivery_bn'=>@发货单号@
     *                  'stock_status'=>@备货单打印状态@
     *                  'deliv_status'=>@发货单打印状态@
     *                  'expre_status'=>@快递单打印状态@
     *                  ===================================
     *                  'status'=>check
     *                  'delivery_bn'=>@发货单号@
     *                  ===================================
     *                  'status'=>cancel
     *                  'delivery_bn'=>@发货单号@
     *                  'memo'=>@备注@
     *                  ===================================
     *                  'status'=>update
     *                  'delivery_bn'=>@发货单号@
     *                  'action'=>updateDetail|addLogiNo
     *                  
     *
     *              )
     * @return void
     * @author 
     **/
    public function status_update($params)
    {
        if($params['operate_time']) $params['delivery_time'] = $params['operate_time'];
        if(!empty($params['bill_logi_no']) && is_array($params['bill_logi_no'])) {
            $dliBill = app::get('ome')->model('delivery_bill');
            foreach($params['bill_logi_no'] as $val) {
                $bill = array();
                $bill['status'] = $params['status'] == 'delivery' ? 1 : ($params['status'] == 'cancel' ? 2 : 0);
                $bill['logi_no'] = $val;
                $delivery_data = app::get('ome')->model('delivery')->dump(array('delivery_bn'=>$params['delivery_bn']),'status,delivery_id');
                $bill['delivery_id'] = $delivery_data['delivery_id'];
                $hadBill = $dliBill->dump(array('delivery_id'=>$bill['delivery_id'],'logi_no'=>$bill['logi_no']), 'log_id');
                if(empty($hadBill)) {
                    $bill['create_time'] = strtotime($params['operate_time']);
                } else {
                    $bill['log_id'] = $hadBill['log_id'];
                }
                $bill['delivery_time'] = strtotime($params['operate_time']);
                $dliBill->save($bill);
            }
        }
        return kernel::single('ome_event_receive_delivery')->update($params);
    }
}
