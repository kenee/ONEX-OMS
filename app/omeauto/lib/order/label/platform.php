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
 * 来源平台
 */
class omeauto_order_label_platform extends omeauto_order_label_abstract implements omeauto_order_label_interface
{
    /**
     * 检查订单数据是否符合要求
     *
     * @param array $orderInfo
     * @param string $error_msg
     * @return bool
     */
    public function vaild($orderInfo, &$error_msg=null)
    {
        if(empty($this->content)){
            $error_msg = '没有设置收货地区规则';
            return false;
        }
        
        //配置的平台
        $contentType = strtolower($this->content['type']);
        
        //订单所属平台
        $shop_type = strtolower($orderInfo['shop_type']);
        
        //检查来源平台
        if(in_array($contentType, ['haoshiqi_taobao', 'haoshiqi_douyin', 'haoshiqi_kuaishou'])) {
            if($shop_type != 'haoshiqi'){
                $error_msg = '不是haoshiqi平台类型';
                return false;
            }
            
            $orderReceiver = app::get('ome')->model('order_receiver')->db_dump(['order_id'=>$orderInfo['order_id']], 'encrypt_source_data');
            if(empty($orderReceiver)) {
                $error_msg = 'haoshiqi类型订单,收货人信息不存在';
                return false;
            }
            
            $encrypt_source_data = @json_decode($orderReceiver['encrypt_source_data'], 1);
            if(!$encrypt_source_data['is_consignee_encrypt']) {
                $error_msg = 'haoshiqi类型订单,收货人加密信息为空';
                return false;
            }
            
            if($contentType == 'haoshiqi_taobao' && !$encrypt_source_data['taobao_oaid']) {
                $error_msg = 'haoshiqi_taobao类型订单,信息为空';
                return false;
            }
            
            if($contentType == 'haoshiqi_douyin' && !$encrypt_source_data['douyin_open_address_id']) {
                $error_msg = 'haoshiqi_douyin类型订单,信息为空';
                return false;
            }
            
            if($contentType == 'haoshiqi_kuaishou' && !$encrypt_source_data['third_info']) {
                $error_msg = 'haoshiqi_kuaishou类型订单,信息为空';
                return false;
            }
        } elseif ($shop_type != $contentType) {
            $error_msg = '订单平台类型'. $shop_type .'与配置类型'. $contentType .'不相同';
            return false;
        }
        
        return true;
    }
}