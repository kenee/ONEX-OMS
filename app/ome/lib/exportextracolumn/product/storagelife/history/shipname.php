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
 * 唯一码历史导出扩展字段 收货人
 * 20180718 by wangjianjun
 */
class ome_exportextracolumn_product_storagelife_history_shipname extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'history_id';

    protected $__extra_column = 'column_ship_name';

    public function associatedData($ids){
        $mdl_storagelife_history = app::get('ome')->model('product_storagelife_history');
        $rs_storagelife_history = $mdl_storagelife_history->getList("*",$ids);
        foreach ($rs_storagelife_history as $var_rsh){
            if($var_rsh["bill_type"] == "1"){ //发货单
                $mdl_ome_delivery = app::get('ome')->model('delivery');
                $delivery = $mdl_ome_delivery->dump(array('delivery_bn'=>$var_rsh['bill_no']),'ship_name');
                if(!empty($delivery)){
                    $tmp_array[$var_rsh[$this->__pkey]] = $delivery["consignee"]["name"];
                }
            }elseif($var_rsh["bill_type"] == "2"){ //退换货单
                $mdl_ome_reship = app::get('ome')->model('reship');
                $rs_reship = $mdl_ome_reship->dump(array("reship_bn"=>$var_rsh['bill_no']),'ship_name');
                if(!empty($rs_reship)){
                    $tmp_array[$var_rsh[$this->__pkey]] = $rs_reship["ship_name"];
                }
            }
        }
        return $tmp_array;
    }

}