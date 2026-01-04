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


class ome_service_stock{

    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct(&$app)
    {
        $this->app = $app;
    }

    /**
     * 清除预占库存
     * @access public
     * @param int $order_id 订单ID
     */
    public function clean_freeze($order_id){
        $orderModel = $this->app->model('orders');
        $order = $orderModel->dump($order_id);
        kernel::single('erpapi_router_request')->set('shop', $order['shop_id'])->order_cleanStockFreeze($order);
    }

    /**
     * 更新库存
     * @access public
     * @param array $stocks 需更新的货号数量多维数组 array('bn'=>'22')
     * @param int $shop_id 店铺ID
     * @param string $shop_type 店铺类型
     */
    public function update_stock($stocks,$shop_id,$shop_type=''){

    }

	/**
	 * 计算回写的最大库存值
	 * @access public
	 * @param string $shop_id 店铺ID
	 * @param int $store_sync_from 回写开始时间
	 * @param int $store_sync_end 回写结束时间
	 * @param int $limit 一次性回写的库存个数
	 * @param int $offset 当前回写的库存位置
	 * @return array
	 */
	public function calculate_stock($shop_id,$store_sync_from='',$store_sync_end='',$offset='0',$limit='100'){
        return null;
	}


	/**
	 * 计算回写的最大库存值
	 * @access public
	 * @param string $shop_id 店铺ID
	 * @param int $store_sync_from 回写开始时间
	 * @param int $store_sync_end 回写结束时间
	 * @param int $limit 一次性回写的库存个数
	 * @param int $offset 当前回写的库存位置
	 * @return array
	 */
	public function shop_calculate_stock($shop_id,$store_sync_from='',$store_sync_end='',$offset='0',$limit='100'){
        return null;
	}

}