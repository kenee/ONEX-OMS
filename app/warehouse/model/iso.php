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

class warehouse_mdl_iso extends dbeav_model{
    
    var $has_many = array('iso_items' => 'iso_items');

    //model层新加扩展数据层
    function iso_items($iso_id) {
        $eoObj = $this->app->model("iso_items");
        $rows['items'] = $eoObj->getList('product_name as name,nums as num,bn,price',array('iso_id'=>$iso_id));
        $total_num = 0;
        $total_price = 0;
        foreach($rows['items'] as $v){
            $total_num += intval($v['num']);
            $total_price += intval($v['num'])*floatval($v['price']);
        }
        $rows['total_num'] = $total_num;
        $rows['total_price'] = $total_price;
        return $rows;
    }

}
