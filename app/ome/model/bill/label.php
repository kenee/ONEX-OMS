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

/**
 * 单据标签
 *
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
class ome_mdl_bill_label extends dbeav_model
{
    /**
     * 获取单据标记列表
     * 
     * @param array $orderId
     * @return mixed
     */
    public function getBIllLabelList($billIds, $billType = 'order')
    {
        if(empty($billIds)){
            return array();
        }
        
        $sql = "SELECT a.*, b.label_code, b.label_color FROM sdb_ome_bill_label AS a LEFT JOIN sdb_omeauto_order_labels AS b ON a.label_id=b.label_id ";
        $sql .= " WHERE a.bill_type='".$billType."' and a.bill_id IN ('". implode("','", $billIds) ."') ";
        $labelList = $this->db->select($sql);

        foreach ($labelList as $lk => $lv) {
            if ($lv['label_value']) {
                $labelValuePreset = kernel::single('ome_bill_label')->labelValuePreset[$lv['label_code']];
                $label_name = [];
                foreach ($labelValuePreset as $pk => $pv) {
                    if ($lv['label_value'] & $pk) { // &位运算符
                        $label_name[] = $pv['label_name'];
                    }
                }
                if ($label_name) {
                    $labelsPreset = kernel::single('ome_bill_label')->orderLabelsPreset[$lv['label_code']];
                    if ($labelsPreset['label_thumb']) {
                        $labelList[$lk]['label_name'] = $labelsPreset['label_thumb'];
                    }
                    $labelList[$lk]['label_name'] .= '('.implode('/', $label_name).')';
                }
            }
        }
        
        return $labelList;
    }
}