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


class ome_rpc_response_version_2_order extends ome_rpc_response_version_base_order
{

   /**
     * 更新订单状态
     * @access public
     * @param Array $order_sdf 待更新订单状态标准结构数据
     */
    public function status_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    /**
     * 更新订单支付状态
     * @access public
     * @param Array $order_sdf  待更新订单支付状态标准结构数据
     */
    public function pay_status_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    /**
     * 更新订单发货状态
     * @access public
     * @param Array $order_sdf 待更新订单发货状态标准结构数据
     */
    public function ship_status_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    /**
     * 添加买家留言
     * @access public
     * @param Array $order_sdf 买家留言标准结构数据
     */
    public function custom_mark_add($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    /**
     * 更新买家留言
     * @access public
     * @param Array $order_sdf 买家留言标准结构数据
     */
    public function custom_mark_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    /**
     * 添加订单备注
     * @access public
     * @param Array $order_sdf 订单备注标准结构数据
     */
    public function memo_add($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }
    
    
    /**
     * 更新订单备注
     * @access public
     * @param Array $order_sdf 订单备注注标准结构数据
     */
    public function memo_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }

    /**
     * 更新订单支付方式
     * @access public
     * @param Array $order_sdf 订单备注注标准结构数据
     */
    public function payment_update($order_sdf){
        return array('rsp'=>'success','msg'=>'','data'=>$order_sdf['order_bn']);
    }

}
?>