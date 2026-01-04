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
 * 发货单的扩展字段批次号
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class wms_extracolumn_delivery_ident extends wms_extracolumn_abstract implements wms_extracolumn_interface{

    protected $__pkey = 'delivery_id';

    protected $__extra_column = 'column_ident';

    /**
     *
     * 获取发货单相关订单的批次号
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        if(empty($ids)){
            return array();
        }
        //批次号处理
        $printqiObj = app::get('ome')->model('print_queue_items');
        $ident_lists = $printqiObj->db->select('SELECT DISTINCT ident FROM sdb_ome_print_queue_items WHERE delivery_id in ('.implode(',',$ids).')');

        $ident_ids = array();
        foreach($ident_lists as $k =>$val){
            $ident_ids[] = $val['ident'];
        }

        $tmp_array= array();
        $ident_arr = $printqiObj->db->select('SELECT ident,'.$this->__pkey.',ident_dly FROM sdb_ome_print_queue_items WHERE delivery_id in ('.implode(',',$ids).')');
        foreach($ident_arr as $k => $ident){
                $ident_dly = $ident['ident'] . '_' . $ident['ident_dly']; //加上批次号序列
                $tmp_array[$ident[$this->__pkey]] = $ident_dly;
        }
        return $tmp_array;
    }

}