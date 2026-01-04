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

class o2o_mdl_shop extends dbeav_model{

    /**
     * 搜索Options
     * @return mixed 返回值
     */
    public function searchOptions(){

    }

    /**
     * _currFilter
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function _currFilter(&$filter){
        $filter['s_type'] = 2;
    }

    public function count($filter=array()){
        $this->_currFilter($filter);
        $row = kernel::single('ome_interface_shop')->count($filter);
        return intval($row[0]['_count']);
    }

    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null){
        $this->_currFilter($filter);
        $rows = kernel::single('ome_interface_shop')->getList($cols, $filter, $offset, $limit, $orderType);
        return $rows;
    }

    public function delete($filter=array(),$subSdf = 'delete'){
        $this->_currFilter($filter);
        $rows = kernel::single('ome_interface_shop')->delete($filter);
        return $rows;
    }

    function modifier_s_status($row){
        if($row == 1){
            return '是';
        }else{
            return '否';
        }
    }

    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema(){
        $schema = array (
            'columns' => array (
                'shop_id' =>
                array (
                  'type' => 'varchar(32)',
                  'required' => true,
                  'pkey' => true,
                  'editable' => false,
                ),
                'shop_bn' =>
                array (
                  'type' => 'varchar(20)',
                  'required' => true,
                  'label' => '店铺编码',
                ),
                'name' =>
                array (
                  'type' => 'varchar(255)',
                  'required' => true,
                  'label' => '店铺名称',
                  'editable' => false,
                  'searchtype' => 'has',
                  'filtertype' => 'normal',
                  'filterdefault' => true,
                  'in_list' => true,
                  'default_in_list' => true,
                  'is_title' => true,
                  'width' => '120',
                ),
                's_status' =>
                array (
                  'type' => 'tinyint(1)',
                  'editable' => false,
                  'label' => '启用',
                  'default' => 1
                ),
            ),
            'idColumn' => 'shop_id',
            'in_list' => array (
                0 => 'shop_bn',
                1 => 'name',
                2 => 's_status',
            ),
            'default_in_list' => array (
                0 => 'shop_bn',
                1 => 'name',
                2 => 's_status',
            ),
        );
        return $schema;
    }
}