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

class openapi_data_original_supplier{

    /**
     * 添加
     * @param mixed $data 数据
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */
    public function add($data, &$code, &$sub_msg)
    {
        $supplier_bn = $data['supplier_bn'];

        $supplierMdl = app::get('purchase')->model('supplier');

        if ($supplierMdl->count(array('supplier_bn'=>$supplier_bn))) {
            return ['rsp' => 'fail', 'msg' => '供应商编码已存在'];
        }

        $area = '';
        if($data['province']){
            $area = $data['province'].'/'.$data['city'].'/'.$data['district'];
            kernel::single('eccommon_regions')->region_validate($area);
        }

        $supplierData = [
            'bn' => $data['supplier_bn'],
            'name' => $data['supplier_name'],
            'company' => $data['company'],
            'area' => $area,
            'addr' => $data['addr'],
            'zip' => $data['zip'],
            'telphone' => $data['contacter'],
            'fax' => $data['fax'],
            'contacter' => $data['contacter'],
            'memo' => $data['memo'],
        ];

        if (!$supplierMdl->insert($supplierData)) {
            return ['rsp' => 'fail', 'msg' => '添加失败'];
        }

        return ['rsp' => 'succ', 'msg' => '添加成功', 'data' => ['supplier_bn' => $supplier_bn]];
    }

    /**
     * edit
     * @param mixed $data 数据
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */
    public function edit($data, &$code, &$sub_msg)
    {
        $supplier_bn = $data['supplier_bn'];

        $supplierMdl = app::get('purchase')->model('supplier');

        $supplier = $supplierMdl->db_dump(['bn'=>$supplier_bn], 'supplier_id');
        if (!$supplier) {
            return ['rsp' => 'fail', 'msg' => '供应商不存在'];
        }

        $area = '';
        if($data['province']){
            $area = $data['province'].'/'.$data['city'].'/'.$data['district'];
            kernel::single('eccommon_regions')->region_validate($area);
        }

            $supplierData = [
            'name' => $data['supplier_name'],
            'company' => $data['company'],
            'area' => $area,
            'addr' => $data['addr'],
            'zip' => $data['zip'],
            'telphone' => $data['contacter'],
            'fax' => $data['fax'],
            'contacter' => $data['contacter'],
            'memo' => $data['memo'],
        ];

        if (!$supplierMdl->update($supplierData, ['supplier_id'=>$supplier['supplier_id']])) {
            return ['rsp' => 'fail', 'msg' => '编辑失败'];
        }

        return ['rsp' => 'succ', 'msg' => '编辑成功', 'data' => ['supplier_bn' => $supplier_bn]];
    }

    /**
     * 获取List
     * @param mixed $data 数据
     * @return mixed 返回结果
     */
    public function getList($data)
    {
    }
    
}
