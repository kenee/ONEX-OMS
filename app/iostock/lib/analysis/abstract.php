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

class iostock_analysis_abstract extends eccommon_analysis_abstract {

    public $logs_options = array(
        0 => array(
            'name' => '呆滞库存总量',
            'flag' => array(),
            'memo' => '',
            'icon' => 'coins.gif',
        ),
        1 => array(
            'name' => '呆滞总成本',
            'flag' => array(),
            'memo' => '',
            'icon' => 'coins.gif',
        ),
    );
    
    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct(&$app){
        parent::__construct($app);
        $this->_extra_view = array('iostock' => 'analysis/extra_view.html');
        $this->_render = kernel::single('iostock_ctl_analysis_stocknsale');
    }

    /**
     * detail
     * @return mixed 返回值
     */
    public function detail(){
    	$analysisStockNsaleObj = app::get('ome')->model('analysis_stocknsale');
    	//呆滞库存总量
    	$sql = 'SELECT sum(balance_nums) as total_store from '.$analysisStockNsaleObj->table_name(1). ' WHERE ' . $analysisStockNsaleObj->_filter($this->_params);
    	$count = $analysisStockNsaleObj->db->selectrow($sql);
    	$this->logs_options[0]['value'] = $count['total_store'];
    	//呆滞总成本
    	$sql = 'SELECT sum(inventory_cost) as total_inventory_cost from '.$analysisStockNsaleObj->table_name(1). ' WHERE ' . $analysisStockNsaleObj->_filter($this->_params);
    	$count = $analysisStockNsaleObj->db->selectrow($sql);
    	$this->logs_options[1]['value'] = $count['total_inventory_cost'];
        foreach($this->logs_options AS $target=>$option){
            $detail[$option['name']]['value'] = $option['value'];
            $detail[$option['name']]['memo'] = $option['memo'];
            $detail[$option['name']]['icon'] = $option['icon'];
            $detail[$option['name']]['br'] = $option['br'] == true ? true : false;
        }
        $this->_render->pagedata['detail'] = $detail;
    }
    
}