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

class ome_event_trigger_logistics{

    public function add($id, $wmsId){
        $channelObj = app::get('channel')->model('channel');
        $channel_detail = $channelObj->dump(array('channel_id'=>$wmsId),'node_id,node_type,channel_id');
        if ($channel_detail['node_id'] && $channel_detail['node_type']) {
                $sdf = $this->dealAddParam($id);
                $rs = kernel::single('erpapi_router_request')->set('wms', $channel_detail['channel_id'])->logistics_create($sdf);
        } else {
            $rs = array('rsp' => 'fail', 'msg'=>'仓储需要绑定');
        }
        return $rs;
    }

    public function dealAddParam($corpId) {
        if($corpId == '-1') {
            $corp = array(
                'type' => 'other',
                'name' => '未选物流'
            );
        } else {
            $field = 'corp_id,type,name';
            $corp = app::get('ome')->model('dly_corp')->db_dump(array('corp_id'=>$corpId), $field);
        }
        return $corp;
    }
}
