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

class logisticsmanager_finder_warehouse
{
    public $addon_cols = "id";
    public $column_control = '操作';
    public $column_control_width = '60';
    public $column_control_order = COLUMN_IN_HEAD;
    
    /**
     * column_control
     * @param mixed $row row
     * @return mixed 返回值
     */
    public function column_control($row)
    {
        $id = $row[$this->col_prefix . 'id'];
        
        $button = "<a href='javascript:void(0);' onclick=\"new Dialog('index.php?app=logisticsmanager&ctl=admin_warehouse&act=edit&p[0]={$id}&finder_id={$_GET['_finder']['finder_id']}',{width:800,height:600,title:'区域仓编辑'}); \">编辑</a>";
        
        return $button;
    }
    
    
    public $detail_shop = '前端店铺同步记录';
    
    /**
     * detail_basic
     * @param mixed $id ID
     * @return mixed 返回值
     */
    public function detail_basic($id)
    {
        $warehouseshopObj = app::get('logisticsmanager')->model('warehouse_shop');
        $warehouselist    = $warehouseshopObj->getlist('*', array('warehouse_id' => $id));
        
        $shopObj = app::get('ome')->model('shop');
        $render  = app::get('logisticsmanager')->render();
        
        foreach ($warehouselist as $k => $v) {
            $shop_detail                    = $shopObj->dump(array('shop_id' => $v['shop_id']), 'name');
            $warehouselist[$k]['shop_name'] = $shop_detail['name'];
        }
        $render->pagedata['warehouselist'] = $warehouselist;
        
        $warehouseshopObj = app::get('logisticsmanager')->model('warehouse_address');
        $addressList      = $warehouseshopObj->getlist('*', array('warehouse_id' => $id));
        
        
        $render                          = app::get('logisticsmanager')->render();
        $render->pagedata['addressList'] = $addressList;
        
        return $render->fetch('admin/warehouse/detail_basic.html');
    }
    
    public $column_regions = '覆盖区域';
    public $column_regions_width = '60';
    
    /**
     * column_regions
     * @param mixed $row row
     * @return mixed 返回值
     */
    public function column_regions($row)
    {
        $region_names = $row['region_names'];
        if (!empty($row['one_level_region_names'])) {
            $region_names = $row['one_level_region_names'];
        }
        return $region_names;
    }
    
}
