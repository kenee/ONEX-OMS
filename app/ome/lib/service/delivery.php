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


class ome_service_delivery{
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
     * 添加发货单
     * @access public
     * @param int $delivery_id 发货单ID
     */
    public function delivery($delivery_id){

    }
    
    /**
     * 更改发货单状态
     * @access public
     * @param int $delivery_id 发货单ID
     * @param string $status 发货单状态
     * @param boolean $queue true：进队列  false：立即发起
     */
    public function update_status($delivery_id,$status='',$queue=false){

    }
    
    /**
     * 更改发货物流信息
     * @access public
     * @param int int $delivery_id 发货单ID
     * @param int $parent_id 合并发货单ID
     * @param boolean $queue true：进队列  false：立即发起
     */
    public function update_logistics_info($delivery_id, $parent_id='',$queue=false){

    }
    #订阅华强宝物流信息
    public function get_hqepay_logistics($delivery_id){

    }
}