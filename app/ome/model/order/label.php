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
 * 订单标签
 *
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
class ome_mdl_order_label extends dbeav_model
{

// ====================================================
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// == 此表已废弃 请转用sdb_ome_bill_label表 2023.09.26 ==
// ====================================================

    /**
     * 获取订单标记列表
     * 
     * @param array $orderId
     * @return mixed
     */
    public function getOrderLabelList($orderIds)
    {
        if(empty($orderIds)){
            return array();
        }
        
        $sql = "SELECT a.*, b.label_code, b.label_color FROM sdb_ome_order_label AS a LEFT JOIN sdb_omeauto_order_labels AS b ON a.label_id=b.label_id ";
        $sql .= " WHERE a.order_id IN (". implode(',', $orderIds) .")  ORDER BY a.label_id DESC";
        $labelList = $this->db->select($sql);
        
        return $labelList;
    }
}