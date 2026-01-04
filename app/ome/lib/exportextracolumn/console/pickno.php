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
 * 出库单关联的拣货单号
 * 
 * @author wangbiao<wangbiao@shopex.cn>
 * @version 1.0
 */
class ome_exportextracolumn_console_pickno extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'stockout_id';

    protected $__extra_column = 'column_pick_no';

    /**
     *
     * 获取拣货单号
     * 
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        
        $stockoutObj    = app::get('purchase')->model('pick_stockout_bills');
        $stockData    = $stockoutObj->db->select("SELECT ". $this->__pkey ." FROM sdb_purchase_pick_stockout_bills WHERE stockout_id in(". implode(',', $ids) .")");
        
        $tmp_array    = array();
        foreach ($stockData as $key => $row)
        {
            //关联拣货单(合并出库时会有多个拣货单号)
            $sql    = "SELECT b.pick_no FROM sdb_purchase_pick_stockout AS a LEFT JOIN sdb_purchase_pick_bills AS b 
                       ON a.bill_id=b.bill_id WHERE a.stockout_id=". $row[$this->__pkey];
            $pickList = $stockoutObj->db->select($sql);
            $pickList = array_map('array_shift', $pickList);
            
            $tmp_array[$row[$this->__pkey]] = implode(';', $pickList);
        }
        
        return $tmp_array;
    }
}