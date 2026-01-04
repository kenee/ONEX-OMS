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


class ome_rpc_request_version_2_order extends ome_rpc_request_version_base_order {

    /**
    * 订单编辑 iframe
    * @access public
    * @param Array $sdf 请求参数
    * @return Array
    */
    public function update_iframe($sdf){
        #判断是否发起请求
        if ($sdf['is_request'] !== true){
            return array('rsp'=>'success','msg'=>'','data'=>array('edit_type'=>'iframe'));
        }
        $order_bn = $sdf['order_bn'];
        if(!empty($order_bn)){
            $shop_id = $sdf['shop_id'];
            $notify_url = $sdf['ext']['notify_url'];
            $params = array(
                'tid' => trim($sdf['order_bn']),
                'notify_url' => base64_encode($notify_url)
            );
            $queue = false;

            if($shop_id){
                $title = '前端店铺('.$sdf['shop_name'].')订单编辑';
            }else{
                return false;
            }

            $log['log_title'] = $title;
            $log['original_bn'] = $order_bn;
            $log['status'] = 'success';
            $log['log_type'] = 'store.trade';
            $method = 'iframe.tradeEdit';
            $mode = 'sync';
            
            $rs = $this->request($method,$params,$callback,$title,$shop_id,5,$queue,$addon,$log,true,'GET');
                    
            return $rs;
        }else{
            return array('rsp'=>'fail','msg'=>'订单号不能为空');
        }
    }
    
    /**
     * 订单编辑 接口
     * @access public
     * @param Array $sdf 订单结构
     * @return boolean
     */
    public function update_order($sdf=''){
        return array('rsp'=>'success','msg'=>'新版本无需发起订单编辑');
    }

}