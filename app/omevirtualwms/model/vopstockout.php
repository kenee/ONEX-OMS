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

class omevirtualwms_mdl_vopstockout extends dbeav_model{
    public $queue = [];

    /**
     * count
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function count($filter=null){
         $sql = "SELECT count(*) as _count FROM sdb_purchase_pick_stockout_bills WHERE status=1 AND o_status=1 AND confirm_status IN(1,2)";
         
         $row = $this->db->selectrow($sql);
         
         return intval($row['_count']);
    }

    public function getlist($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null){
        
        //$stockoutObj = app::get('purchase')->model('pick_stockout_bills');
        //$rows = $stockoutObj->getList('*', array('status'=>1, 'o_status'=>1, 'confirm_status'=>array(1, 2)), $limit, $offset);
        
        $sql = "SELECT * FROM sdb_purchase_pick_stockout_bills WHERE status=1 AND o_status=1 AND confirm_status IN(1,2)";
        $rows = $this->db->selectLimit($sql,$limit,$offset);
        
        return $rows;
    }

    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema(){
        $schema = array (
            'columns' => array (
                'stockout_no' =>
                array (
                        'type' => 'varchar(32)',
                        'required' => true,
                        'label' => '出库单号',
                        'width' => 140,
                        'editable' => false,
                        'in_list' => true,
                        'default_in_list' => true,
                        'order' => 2,
                ),
                'operator' => array (
                    'type' => 'varchar(100)',
                    'label' => '操作人',
                    'editable' => false,
                    'width' =>100,
                ),
               'create_time' => array (
                    'type' => 'time',
                    'label' => '创建日期',
                    'width' =>160,
                    'editable' => false,
                ),
            ),
            'idColumn' => 'stockout_no',
            'in_list' => array (
                0 => 'stockout_no',
                1 => 'operator',
                2 => 'create_time',
               ),
            'default_in_list' => array (
                0 => 'stockout_no',
                1 => 'operator',
                2 => 'create_time',
            ),
        );
        
        return $schema;
    }
}
