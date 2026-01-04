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

class wap_mdl_delivery extends dbeav_model{

    var $has_many = array(
        'delivery_items' => 'delivery_items',
    );

    var $defaultOrder = array('delivery_id',' DESC');

    //格式化filter
    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter, $tableAlias=null, $baseWhere=null)
    {
        $where    = '';
        
        //订单号(合并订单有多个order_bn以|分隔)
        if($filter['order_bn'])
        {
            $orderObj    = app::get('ome')->model('orders');
            $orderRow    = $orderObj->dump(array('order_bn'=>$filter['order_bn']), 'order_id');
            if($orderRow)
            {
                $where    .= " AND order_bn LIKE '%". $filter['order_bn'] ."%'";
            }
            else
            {
                $where    .= " AND order_bn='no_false'";
            }
            
            unset($filter['order_bn']);
        }
        
        return parent::_filter($filter, $tableAlias, $baseWhere) . $where;
    }
}
?>
