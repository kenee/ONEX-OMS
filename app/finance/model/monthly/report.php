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


class finance_mdl_monthly_report extends dbeav_model{
    
    function modifier_status($row){
        $status = array('未启用','未关账','已关账');
        return $status[$row];
    }


    function getListByTime($begin_time)
    {
        return $this->db->select('select shop_id from sdb_finance_monthly_report where begin_time = '.$begin_time);
    }

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter, $tableAlias = NULL, $baseWhere = NULL){

        if(isset($filter['shop_id']))
        {
            $shop_info = app::get("ome")->model("shop")->getList('shop_id',array('name'=>$filter['shop_id']),0,1);
            if($shop_info)
            {
            	$filter['shop_id'] = $shop_info[0]['shop_id'];
            }

        }

        return parent::_filter($filter, $tableAlias, $baseWhere);
    }


    /**
     * 获取ShopList
     * @return mixed 返回结果
     */
    public function getShopList()
    {
        $res = $this->db->select('select report.shop_id,shop.name from sdb_finance_monthly_report as report left join sdb_ome_shop as shop on report.shop_id = shop.shop_id group by report.shop_id');
        return $res;
    }
}
