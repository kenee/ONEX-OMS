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


class ome_service_reship{

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
     * 添加退货单
     * @access public
     * @param int $reship_id 退货单ID
     */
    public function reship($reship_id){
        $reshipModel = $this->app->model('reship');
        $reship = $reshipModel->dump($reship_id);
        kernel::single('erpapi_router_request')->set('shop', $reship['shop_id'])->aftersale_addReship($reship);
    }
    
    /**
     * 退货单状态更新
     * @access public
     * @param int $reship_id 退货单ID
     */
    public function update_status($reship_id){
        $reshipModel = $this->app->model('reship');
        $reship = $reshipModel->dump($reship_id);
        kernel::single('erpapi_router_request')->set('shop', $reship['shop_id'])->aftersale_updateReshipStatus($reship);
    }
}