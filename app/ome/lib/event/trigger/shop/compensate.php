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

class ome_event_trigger_shop_compensate{

    public function syncRecord($shopId, $sdf=[]) {
        //默认获取最近一天的赔付单
        if(empty($sdf)) {
            $sdf = [
                'start_modified' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'end_modified' => date('Y-m-d H:i:s')
            ];
            $pageNo = 1;
            $sdf['page_size'] = 50;
        } else {
            $single = true;
            $pageNo = $sdf['page_no'];
        }
        
        $model = app::get('ome')->model('compensate_record');
        do {
            $sdf['page_no'] = $pageNo;
          
            $result = kernel::single('erpapi_router_request')->set('shop', $shopId)->compensate_syncRecord($sdf);

            if (empty($result['data'])) {
                break;
            }
            foreach ($result['data'] as $v) {
                $v['shop_id'] = $shopId;
                $row = $model->db_dump(['compensate_bn'=>$v['compensate_bn'], 'shop_id'=>$shopId], 'id');
                if($row['id']) {
                    $model->update($v, ['id'=>$row['id']]);
                    $v['id'] = $row['id'];
                } else {
                    $model->insert($v);
                }
                kernel::single('ome_compensate_record')->insertAftersale($v['id']);
            }
            if($single) {
                break;
            }
            if(count($result['data']) < $sdf['page_size']) {
                break;
            }
            $pageNo ++;
        } while(true);
        return $result;
    }

    #同步小额打款
    public function syncIndemnity($shopId, $sdf=[]) {
        //默认获取最近一天的赔付单
        if(empty($sdf)) {
            $sdf = [
                'start_modified' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'end_modified' => date('Y-m-d H:i:s')
            ];
            $pageNo = 1;
            $sdf['page_size'] = 50;
        } else {
            $single = true;
            $pageNo = $sdf['page_no'];
        }
        $model = app::get('ome')->model('compensate_record');
        do {
            $sdf['page_no'] = $pageNo;
          
            $result = kernel::single('erpapi_router_request')->set('shop', $shopId)->compensate_syncIndemnity($sdf);

            if (empty($result['data'])) {
                break;
            }
            foreach ($result['data'] as $v) {
                $v['shop_id'] = $shopId;
                $row = $model->db_dump(['compensate_bn'=>$v['compensate_bn'], 'shop_id'=>$shopId], 'id');
                if($row['id']) {
                    $model->update($v, ['id'=>$row['id']]);
                    $v['id'] = $row['id'];
                } else {
                    $model->insert($v);
                }
                kernel::single('ome_compensate_record')->insertAftersale($v['id']);
            }
            if($single) {
                break;
            }
            if(count($result['data']) < $sdf['page_size']) {
                break;
            }
            $pageNo ++;
        } while(true);
        return $result;
    }
}