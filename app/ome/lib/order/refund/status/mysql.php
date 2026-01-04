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

class ome_order_refund_status_mysql extends ome_order_refund_status_abstract {

    /**
     * fetch
     * @param mixed $tid ID
     * @param mixed $nodeId ID
     * @param mixed $shopId ID
     * @return mixed 返回值
     */
    public function fetch($tid, $nodeId, $shopId){
        $key = $this->getKey($tid, $nodeId);
        $tnMdl = app::get('erpapi')->model('tmc_notify');
        $list = $tnMdl->getList('oid, sdf', ['tmc_key'=>$key]);
        $result = [];
        foreach ($list as $v) {
            $result[$v['oid']] = $v['sdf'];
        }
        return [true, ['data'=>$result]];
    }

    /**
     * store
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function store($sdf) {
        $key = $this->getKey($sdf['tid'], $sdf['node_id']);
        $inData = [
            'tmc_key' => $key,
            'tid' => $sdf['tid'],
            'oid' => $sdf['oid'],
            'sdf' => json_encode($sdf)
        ];
        $tnMdl = app::get('erpapi')->model('tmc_notify');
        $old = $tnMdl->db_dump(['tid'=>$sdf['tid'],'oid' => $sdf['oid']], 'id');
        if($old['id']) {
            $tnMdl->update($inData, ['id'=>$old['id']]);
            $msg = '更新成功';
        } else {
            $tnMdl->insert($inData);
            $msg = '插入成功';
        }
        return [true, ['msg'=>$msg]];
    }
}