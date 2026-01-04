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

class ome_event_trigger_shop{

    function syncShop($id, $wmsId){
        $channelObj = app::get('channel')->model('channel');
        $channel_detail = $channelObj->dump(array('channel_id'=>$wmsId),'node_id,node_type,channel_id');
        if ($channel_detail['node_id'] && $channel_detail['node_type']) {
            $sdf = $this->dealAddParam($id);
            $shop_config = app::get('finance')->getConf('shop_config_'.$wmsId);
            

            if ($shop_config[$sdf['shop_bn']]) {
                $sdf['wms_shop_bn'] = $shop_config[$sdf['shop_bn']];

                $rs = kernel::single('erpapi_router_request')->set('wms', $channel_detail['channel_id'])->shop_update($sdf);
            } else {
                $rs = kernel::single('erpapi_router_request')->set('wms', $channel_detail['channel_id'])->shop_create($sdf);

                if ($shopId != '-1' && $rs['rsp'] == 'succ' && $rs['data']['msg']['jingdong_eclp_master_insertShop_responce']['insertshop_result']) {
                   $shop_config[$sdf['shop_bn']] = $rs['data']['msg']['jingdong_eclp_master_insertShop_responce']['insertshop_result'];
                }
                app::get('finance')->setConf('shop_config_'.$wmsId,$shop_config);
            }

        } else {
            $rs = array('rsp' => 'fail', 'msg'=>'仓储需要绑定');
        }
        return $rs;
    }

    public function dealAddParam($shopId) {
        if($shopId == '-1') {
            $shop = array(
                'shop_bn' => 'noshopcode',
                'name' => '没有店铺'
            );
        } else {
            $field = 'shop_id, shop_bn, name, shop_type, area, zip, addr, default_sender, mobile, tel';
            $shop = app::get('ome')->model('shop')->db_dump(array('shop_id'=>$shopId), $field);
            $area = $shop['area'];
            if ($area) {
                $area = explode(':',$area);
                $area = explode('/',$area[1]);
                $shop['province'] = $area[0];
                $shop['city'] = $area[1];
                $shop['district'] = $area[2];
            }
        }
        return $shop;
    }
}
