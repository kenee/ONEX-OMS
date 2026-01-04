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

class ediws_accountsettlement{

    
   

    /**
     * 处理
     * @param mixed $orders orders
     * @return mixed 返回值
     */
    public function process($orders)
    {
        
        $settlement_ordersMdl = app::get('ediws')->model('account_settlement_orders');
        $o = kernel::single('financebase_data_bill_jdlvmi');
        $title = $o->getTitle();
        $title = array_values($title);
        $oids = array();
        $task_info = array();
        $task_info['queue_data']['title'] = $title;
        $task_info['queue_data']['shop_id'] = $orders[0]['shop_id'];
        $queueData['queue_data']['shop_type']  = '360buy';
        $task_info['queue_data']['data'] = array();
        $data = array();
        foreach($orders as $v){
            //100700 实销实结销售单
            //100300  售后退货
            if($v['sync_status']=='1') continue;
            $v['business_time'] = $v['business_time'] ? $v['business_time'] : time();
            $data[] = array(
                '0' =>  $v['orderNo'],
                '1' =>  $v['expenseTypeName'],
                '2' =>  sprintf('%.2f',$v['bills_amount']),
                '3' =>  date('Y-m-d H:i:s',$v['business_time']),
                '4' =>  $v['shqid'],
                '5' =>  $v['orderNo'].'_'.$v['oid'],
            );

            $oids[] = $v['oid'];
        }
        
        $task_info['queue_data']['data'] = $data;
      
        
        $rs = $o->process(1,$task_info['queue_data'],$errmsg);
       
      
        //更新同步状态
        if($oids){

            $sync_status = 2;
            if($rs){
                $sync_status = 1;
            }
            $error_msg = serialize($errmsg);
            $updata =array('sync_status'=>$sync_status);
            if($error_msg){
                $updata['error_msg'] = $error_msg;
            }
            $settlement_ordersMdl->update($updata,array('oid'=>$oids));
        }
        
        return [true];
    }
}


?>
