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

class ome_event_trigger_supplier{

    function syncSupplier($supplierId, $wmsId){
        $channelObj = app::get('channel')->model('channel');
        $channel_detail = $channelObj->dump(array('channel_id'=>$wmsId),'node_id,node_type,channel_id');
        if ($channel_detail['node_id'] && $channel_detail['node_type']) {
            $sdf = $this->dealAddParam($supplierId);

            $supplierRelationModel = app::get('wmsmgr')->model('supplier_relation');
            $supplierRelation = $supplierRelationModel->db_dump(array('wms_id'=>$wmsId,'supplier_id'=>$supplierId));

            if ($supplierRelation['wms_supplier_bn']) {
                $sdf['wms_supplier_bn'] = $supplierRelation['wms_supplier_bn'];
                $rs = kernel::single('erpapi_router_request')->set('wms', $channel_detail['channel_id'])->supplier_update($sdf);
            } else {
                $rs = kernel::single('erpapi_router_request')->set('wms', $channel_detail['channel_id'])->supplier_create($sdf);

                if ($supplierId != '-1' && $rs['rsp'] == 'succ' && $rs['data']['msg']['jingdong_eclp_master_addSupplier_responce']['addsupplier_result']) {
                    $sdata = array('wms_id'=>$wmsId,'supplier_id'=>$supplierId,'wms_supplier_bn'=>$rs['data']['msg']['jingdong_eclp_master_addSupplier_responce']['addsupplier_result']);
                    $supplierRelationModel->db_save($sdata);
                }
            }


        } else {
            $rs = array('rsp' => 'fail', 'msg'=>'仓储需要绑定');
        }
        return $rs;
    }

    public function dealAddParam($supplierId) {
        if($supplierId == '-1') {
            $supplier = array(
                'bn' => 'nosuppliercode',
                'name' => '没有供应商'
            );
        } else {
            $field = 'supplier_id, bn, name, area, addr, telphone, fax, contacter';
            $supplier = app::get('purchase')->model('supplier')->db_dump(array('supplier_id' => $supplierId), $field);
            $area = $supplier['area'];
            if ($area) {
                $area = explode(':',$area);
                $area = explode('/',$area[1]);
                $supplier['province'] = $area[0];
                $supplier['city'] = $area[1];
                $supplier['district'] = $area[2];
            }
        }
        return $supplier;
    }
}
