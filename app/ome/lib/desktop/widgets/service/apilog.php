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

class ome_desktop_widgets_service_apilog{
       
    /**
     * 获取_menugroup_bak
     * @return mixed 返回结果
     */
    public function get_menugroup_bak(){
        $aObj = app::get('ome')->model('api_log');
        $oObj = app::get('ome')->model('orders');
        $data['label'] = '同步管理';
        $data['type'] = 'apilog';
        $data['value']['0']['count'] = $aObj->count(array('status'=>'fail','api_type'=>'request'));
        $data['value']['0']['link'] = 'index.php?app=ome&ctl=admin_api_log&act=index&p[0]=fail&p[1]=request';
        $data['value']['0']['label'] = '信息回写失败';
        $data['value']['1']['count'] = $oObj->count(array('is_fail'=>'true'));
        $data['value']['1']['link'] = 'index.php?app=ome&ctl=admin_order_fail&act=index';
        $data['value']['1']['label'] = '订单下载失败';
        return $data;
    }
}