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

class ome_desktop_widgets_service_tody{
	
    /**
     * 获取_menugroup
     * @return mixed 返回结果
     */
    public function get_menugroup(){
        $today = array(strtotime(date('Y-m-d',time())),strtotime(date('Y-m-d',(time()+86400))));
        $orderObj = app::get('ome')->model('orders');
        $data['label'] = '今日';
        $data['type'] = 'tody';
        $data['value']['0']['count'] = $orderObj->count(array('createtime|between' =>$today));
        $data['value']['0']['link'] = 'javascript:void(0)';
        $data['value']['0']['label'] = '今日订单';
        $data['value']['1']['count'] = $orderObj->count(array('process_status' =>'unconfirmed','createtime|between' =>$today, 'status'=>'active'));
        $data['value']['1']['link'] = 'javascript:void(0)';
        $data['value']['1']['label'] = '今日未确认';
        $data['value']['2']['count'] = $orderObj->count(array('ship_status' =>'1','createtime|between' =>$today));
        $data['value']['2']['link'] = 'javascript:void(0)';
        $data['value']['2']['label'] = '今日已发货';
        return $data;
	}
}