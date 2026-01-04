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

class sales_mdl_delivery_order_item extends dbeav_model
{

    //是否有导出配置
    public $has_export_cnf = true;

    public $export_name = '发货销售明细单';

    public $filter_use_like = true;

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter, $tableAlias = null, $baseWhere = null)
    {
        // 多订单号查询
        if ($filter['order_bn'] && is_string($filter['order_bn']) && strpos($filter['order_bn'], "\n") !== false) {
            $filter['order_bn'] = array_unique(array_map('trim', array_filter(explode("\n", $filter['order_bn']))));
        }

        return parent::_filter($filter, $tableAlias, $baseWhere);
    }

    /**
     * 添加ReturnNum
     * @param mixed $reshipItems reshipItems
     * @return mixed 返回值
     */
    public function addReturnNum($reshipItems) {
        $filter = [
            'order_item_id' => array_column($reshipItems, 'order_item_id'),
            'filter_sql' => 'nums <> return_num'
        ];
        $items = $this->getList('id,order_item_id,nums,return_num,return_amount', $filter);
        $orderItemIdItems = [];
        foreach($items as $v) {
            $orderItemIdItems[$v['order_item_id']][] = $v;
        }
        foreach($reshipItems as $v) {
            $num = intval($v['normal_num']+$v['defective_num']);
            if ($num <= 0) {
                continue;
            }
            $amount = $v['amount'] ? : $num * $v['price'];
            $price = $amount/$num;
            if($orderItemIdItems[$v['order_item_id']]) {
                foreach($orderItemIdItems[$v['order_item_id']] as $ik => $iv) {
                    if($num < 1) {
                        break;
                    }
                    $valid = $iv['nums']-$iv['return_num'];
                    if($valid < 1) {
                        break;
                    }
                    if($valid < $num) {
                        $returnNum = $valid;
                    } else {
                        $returnNum = $num;
                    }
                    $num -= $returnNum;
                    $orderItemIdItems[$v['order_item_id']]['return_num'] += $returnNum;
                    $sql = 'update sdb_sales_delivery_order_item set
                            return_num=return_num+'.$returnNum.',
                            return_amount=return_amount+'.sprintf('%.2f', $price*$returnNum).'
                            where id='.$iv['id'];
                    $this->db->exec($sql);
                }
            }
        }
    }
}
