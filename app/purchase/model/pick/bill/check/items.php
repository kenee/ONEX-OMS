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

class purchase_mdl_pick_bill_check_items extends dbeav_model
{

    public $order_label = [
        '0' => '未知',
        '1' => '普通订单',
        '2' => '原订单',
        '3' => '换订单',
        '4' => '二换订单',
        '5' => '未知订单',
    ];

    /**
     * 获取CheckList
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function getCheckList($params = [])
    {
    	if (!$params['bill_id']) {
    		return [];
    	}
    	$filter = [
    		'bill_id' => $params['bill_id'],
    	];
    	if ($params['barcode_list']) {
    		$filter['barcode|in'] = $params['barcode_list'];
    	}
    	$list = $this->getList('*', $filter);
    	return $list;
    }

}
