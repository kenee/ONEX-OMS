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

class omeanalysts_mdl_ome_refundNoreturn extends dbeav_model
{
    
    var $has_export_cnf = true;
    
    var $export_name = '仅退款未退货报表';
    
    public function exportName(&$data, $filter = array())
    {
        $data['name'] = $this->export_name . '-' . date('Y-m-d H:i:s', time());
    }
    
    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */
    public function table_name($real = false)
    {
        if($real){
            $table_name = 'sdb_ome_refund_noreturn';
        }else{
            $table_name = 'refund_noreturn';
        }
        return $table_name;
    }
    
    /**
     * count
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function count($filter = null)
    {
        $sql  = "SELECT count(*) as _count FROM sdb_ome_refund_noreturn WHERE  " . $this->_filter($filter);
        $rows = $this->db->select($sql);
        return $rows[0]['_count'];
    }

    public function getlist($cols = '*', $filter = array(), $offset = 0, $limit = -1, $orderType = null)
    {
        $sql = "SELECT * FROM sdb_ome_refund_noreturn WHERE  " . $this->_filter($filter);
        if ($orderType) $sql .= 'order by ' . (is_array($orderType) ? implode($orderType, ' ') : $orderType);

        $rows = $this->db->selectLimit($sql, $limit, $offset);

        return $rows;
    }

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter, $tableAlias = null, $baseWhere = null)
    {
        $baseWhere = [];
    
        if ($filter['time_from'] && $filter['time_to']) {
            $time_from = $filter['time_from'].' 00:00:00';
            // $time_to = $filter['time_to'].' 23:59:59';
            $time_to = date('Y-m-d 00:00:00', strtotime($filter['time_to'] . ' +1 day'));
    
            $baseWhere[] = "at_time BETWEEN '".$time_from."' AND '".$time_to."'";
        }
        
        //订单状态
        if($filter['order_status'] && $filter['order_status'] == '99'){
            $baseWhere[] = " order_status = '0' ";
            unset($filter['order_status']);
        }
    
        //退款状态
        if($filter['refund_status'] && $filter['refund_status'] == '99'){
            $baseWhere[] = " refund_status = '0' ";
            unset($filter['refund_status']);
        }
    
        //退货状态
        if($filter['return_status'] && $filter['return_status'] == '99'){
            $baseWhere[] = " return_status = '0' ";
            unset($filter['return_status']);
        }
        
        $filter = array_filter($filter);
        return parent::_filter($filter,$tableAlias,$baseWhere);

    }
    
    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema()
    {
        return app::get('ome')->model('refund_noreturn')->get_schema();
    }
}