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

class ome_order_delivery{

    /**
     *
     * according to the order_id, find the related delivery
     * @param Int $order_id 
     */
    function getDlyIdsByOrdId($order_id, $status = 'succ'){
        $dlyOrderObj  = app::get('ome')->model('delivery_order');
        $delivery_ids = $dlyOrderObj->db->select("SELECT dord.delivery_id FROM sdb_ome_delivery_order AS dord
                                            LEFT JOIN sdb_ome_delivery AS d ON(dord.delivery_id=d.delivery_id)
                                            WHERE dord.order_id={$order_id} AND (d.parent_id=0 OR d.is_bind='true') AND d.disabled='false' AND d.status ='{$status}'");
        $ids = array();
        if($delivery_ids){
            foreach($delivery_ids as $v){
                $ids[] = $v['delivery_id'];
            }
        }

        return $ids;
    }
}