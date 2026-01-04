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

class ome_mdl_tbfx_order_items extends dbeav_model{

    /**
     * 获取OrderByOrderId
     * @param mixed $data 数据
     * @return mixed 返回结果
     */
    public function getOrderByOrderId($data){
		$filter = array('item_id'=>$data['item_id'],'obj_id'=>$data['obj_id']);
		return $this->getList('buyer_payment',$filter);
	}

    /**
     * 获取CostitemByOrderId
     * @param mixed $order_id ID
     * @return mixed 返回结果
     */
    public function getCostitemByOrderId($order_id){
		$filter = array('order_id'=>$order_id);
		return $this->getList('SUM(buyer_payment) as cost_items',$filter);		
	}
}